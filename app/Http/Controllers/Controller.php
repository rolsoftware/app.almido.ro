<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


abstract class Controller extends BaseController
{
    use AuthorizesRequests,  ValidatesRequests;

    public $title = "Title";

    public function __construct($permission = '')
    {
        $this->middleware('auth');

        if (! empty($permission)) {
            $this->middleware('permission:'.$permission.'-list|'.$permission.'-create|'.$permission.'-edit|'.$permission.'-delete', ['only' => ['index', 'show']]);
            $this->middleware('permission:'.$permission.'-create', ['only' => ['create', 'store']]);
            $this->middleware('permission:'.$permission.'-edit', ['only' => ['edit', 'update']]);
            $this->middleware('permission:'.$permission.'-delete', ['only' => ['destroy']]);
        }

        if (Auth::user()) {
            $menu_items = $this->menu();
            $system['user']             = Auth::user();
            $system['menu']['active']   = "Yes";
            $system['menu']['active']   = "Yes";

            $title = $this->title;
            View::share(compact('menu_items', 'system', 'title'));
        }
    }

    public function menu()
    {
        $path = resource_path('json/menu.json');

        if (! file_exists($path)) {
            return [];
        }

        $menu = json_decode(file_get_contents($path), true);

        return $menu;
    }
}
