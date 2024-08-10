<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class AboutController extends Controller
{

    public function __construct()
    {
        parent::__construct("app:about");
    }

    public function index()
    {
        Artisan::call('about --json');
        $rows = json_decode(Artisan::output());
        return view('base.about.index',compact('rows'));
    }
}
