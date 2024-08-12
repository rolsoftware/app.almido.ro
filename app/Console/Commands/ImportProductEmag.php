<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ImportProductEmag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emag:import-product {--dummy} {--page=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from Emag';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dummy          = $this->option('dummy');
        $option_page    = $this->option('page');

        $this->info('Dummy: ' . $dummy);

        $this->info('Importing products from emag.ro ...');

        # Get count
        if(!$dummy){
            $response = Http::withBasicAuth(env('EMAG_USERNAME'), env('EMAG_PASSWORD'))->post('https://marketplace-api.emag.ro/api-3/product_offer/count');
            $data = $response->json();
            sleep(5);
        }else{
            $data = json_decode(file_get_contents(resource_path('json/emag_product_count.json')), true);
        }

        if($data['isError'] == true) {
            $this->error('Error: ' . implode(",",$data['messages']));
            return;
        }

        # Check if the number of products is the same
        $emag_products  = $data['results']['noOfItems'];
        $app_products   = Product::count();

        if($emag_products == $app_products) {
            $this->info('Products are sincronized');
            return;
        }

        # Calculate the number of pages
        $page = ceil($app_products / $data['results']['itemsPerPage']);
        if($page == 0) $page = 1;
        if($page == ($app_products/$data['results']['itemsPerPage'])) $page++;

        if($option_page > $page) $page = $option_page;

        $response = null;
        $data = null;
        if(!$dummy){
            $response = Http::withBasicAuth(env('EMAG_USERNAME'), env('EMAG_PASSWORD'))->post('https://marketplace-api.emag.ro/api-3/product_offer/read', [
                'currentPage' => $page,
            ]);
            $data = $response->json();
            if($data['isError'] == true) {
                $this->error('Error: ' . implode(",",$data['messages']));
                return;
            }

            $rows = $data['results'];
        }else{
            $data = json_decode(file_get_contents(resource_path('json/emag_product_read_'.$page.'.json')), true);
            $rows = $data['results'];
        }


        $progressBar = $this->output->createProgressBar(count($rows));
        $progressBar->start();
        foreach ($rows as $key => $row) {

            $product = Product::where('code', $row['part_number'])->first();
            if(!$product) $product = Product::where('ean', $row['ean']['0'])->first();

            if(!$product) {
                $product_insert['category_id'] = 1;
                $product_insert['code']        = $row['part_number'];
                $product_insert['ean']         = $row['ean']['0'];
                $product_insert['brand']       = $row['brand'];
                $product_insert['name']        = $row['name'];
                $product_insert['description'] = $row['description'];
                $product_insert['price']       = $row['sale_price'];
                $product_insert['vat']         = 19;
                $product_insert['value']       = $row['sale_price'] + ($row['sale_price'] * 19 / 100);
                $product_insert['status']      = 'Active';
                $product                       = Product::updateOrCreate($product_insert);

                # Import images
                foreach ($row['images'] as $key => $image) {
                    $response = Http::get($image['url']);

                    if ($response->successful()) {
                        $directory = storage_path("app/public/products/".$product->id."/");
                        if (!File::exists($directory))  File::makeDirectory($directory, 0755, true);

                        $image_path = $directory . '/' . $product->code.'_'.$key.'.jpg';
                        file_put_contents($image_path, file_get_contents($image['url']));

                        $product_image = ProductImage::create([
                            'product_id'=> $product->id,
                            'name'      => $product['code'].'_'.$key.'.jpg',
                            'path'      => $image_path,
                            'size'      => '0',
                            'dimension' => '0x0',
                            'order'     => $key,
                            'default'   => $key == 0 ? 'Yes' : 'No',
                            'status'    => 'Active',
                        ]);

                    }

                }
            }

            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
