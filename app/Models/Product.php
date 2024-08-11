<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;
    protected $fillable = ['category_id', 'code', 'ean', 'brand', 'name', 'description', 'price', 'vat', 'value', 'stock', 'status'];

    public $sortable = ['id', 'category_id', 'code', 'ean', 'brand', 'name', 'description', 'price', 'vat', 'value', 'stock', 'status'];

    protected $appends  = ['first_image'];

    public function category()
    {
        // return $this->belongsTo(ProductCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getFirstImageAttribute()
    {
        # return first image in base64
        $image = $this->images()->where('default','Yes')->first();
        $path = "build/images/product/no-image.svg";

        if($image) {
            return  'data:image/jpeg;base64,'.base64_encode(file_get_contents($image->path));
        }
        return $path;
    }
}
