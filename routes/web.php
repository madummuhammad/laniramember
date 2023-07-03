<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RajaongkirController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BrandController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix' => '/','middleware'=>'auth'], function() {
	Route::get('/',[HomeController::class,'index']);

	Route::get('/product/{id}',[ProductController::class,'product_detail']);

	Route::group(['prefix' => '/cart'], function() {
		Route::get('ready_stock',[CartController::class,'ready_stock']);
		Route::get('po',[CartController::class,'po']);
		Route::post('/checkout',[CartController::class,'checkout']);
		Route::get('/checkout',[CartController::class,'checkout_view']);
		Route::post('',[CartController::class,'add']);
		Route::delete('',[CartController::class,'delete']);
		Route::post('order',[CartController::class,'order']);
	});

	Route::group(['prefix' => '/rajaongkir'], function() {
		Route::get('province',[RajaongkirController::class,'province']);
		Route::get('city',[RajaongkirController::class,'city']);
		Route::get('kecamatan',[RajaongkirController::class,'kecamatan']);
		Route::get('expedisi',[RajaongkirController::class,'expedisi']);
	});

	Route::group(['prefix' => '/brand'], function() {
		Route::get('ready_stock',[BrandController::class,'ready_stock']);
		Route::get('ready_stock/{brand_id}',[ProductController::class,'list_ready_stock']);
		Route::get('po',[BrandController::class,'po']);
		Route::get('po/{brand_id}',[ProductController::class,'list_po']);
	});

	Route::group(['prefix' => '/order'], function() {
		Route::get('/{id}',[OrderController::class,'detail']);
		Route::get('/confirm/{id}',[OrderController::class,'confirm']);
		Route::post('/confirm/{id}',[OrderController::class,'confirm_proses']);
		Route::get('/',[OrderController::class,'index']);
	});

});
Route::get('/login',[MemberController::class,'login'])->name('login');
Route::post('/login',[MemberController::class,'loginProses']);
Route::post('/logout',[MemberController::class,'logout']);
Route::get('/registrasi',[MemberController::class,'registrasi']);
Route::post('/registrasi',[MemberController::class,'registrasiProses']);
// Route::get('/product/{id}','ProductController@product_detail');
// Route::get('/login','MemberController@login');
// Route::post('/login','MemberController@loginProses');
