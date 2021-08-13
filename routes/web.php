<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('index');
Route::get('category', [WelcomeController::class, 'category'])->name('category');

Route::view('products', 'product')->name('products.single')->middleware('auth');

Route::middleware('guest')->group(function (Router $router) {
    $router->get('login', [AuthController::class, 'showForm'])->name('login');
    $router->post('login', [AuthController::class, 'login'])->name('auth.login');

    $router->get('register', [RegisterController::class, 'showForm'])->name('register');
    $router->post('register', [RegisterController::class, 'register'])->name('auth.register');
});
