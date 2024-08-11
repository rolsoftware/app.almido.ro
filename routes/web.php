<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\Base\HomeController::class, 'root'])->name('root');
Route::get('/about', [App\Http\Controllers\Base\AboutController::class, 'index'])->name('about');
Route::get('/app/role-permission/{role}', [App\Http\Controllers\Base\RolePermissionController::class, 'show'])->name('role-permission.show');
Route::resource('/app/role', App\Http\Controllers\Base\RoleController::class);
Route::resource('/app/permission', App\Http\Controllers\Base\PermissionController::class);
Route::resource('/app/var', App\Http\Controllers\Base\VarsController::class);
Route::resource('/app/nomenclature', App\Http\Controllers\Base\NomenclatureController::class);
Route::resource('/app/nomenclatureitems', App\Http\Controllers\Base\NomenclatureItemsController::class);

# Users
Route::get('/app/user/password/{user}', [App\Http\Controllers\Base\UserController::class, 'password'])->name('user.password');
Route::put('/app/user/update-password/{user}', [App\Http\Controllers\Base\UserController::class, 'updatePassword'])->name('user.updatePassword');
Route::get('/app/user/export', [App\Http\Controllers\Base\UserController::class, 'export'])->name('user.export');
Route::resource('/app/user', App\Http\Controllers\Base\UserController::class);


# Product
Route::resource('/product', App\Http\Controllers\Product\ProductController::class);
Route::resource('/product-category', App\Http\Controllers\Product\CategoryController::class);

