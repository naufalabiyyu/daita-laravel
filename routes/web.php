<?php

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
Route::get('/', 'HomeController@index')->name('home');

Route::get('/product', 'ProductController@index')->name('product');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

// Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'CartController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::post('/payment/handling', 'CheckoutController@callback');
Route::get('/payment/cancel', 'CheckoutController@midtranscancel');
Route::get('/payment/finish', 'CheckoutController@midtransfinish');
Route::get('/payment/unfinish', 'CheckoutController@midtransunfinish');
Route::get('/payment/error', 'CheckoutController@midtranserror');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/getCity/{id}', 'CartController@getCity');
    Route::post('/getOngkir', 'CartController@getOngkir');
    Route::post('/cart/{id}', 'CartController@update')->name('cart-update-quantity');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Route::get('/dashboard/product', 'DashboardProductController@index')->name('dashboard-product');
    // Route::get('/dashboard/product/create', 'DashboardProductController@create')->name('dashboard-product-create');
    // Route::post('/dashboard/product/', 'DashboardProductController@store')->name('dashboard-product-store');
    // Route::get('/dashboard/product/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
    // Route::post('/dashboard/product/{id}', 'DashboardProductController@update')->name('dashboard-product-update');
    
    // Route::post('/dashboard/product/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
    // Route::get('/dashboard/product/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', 'DashboardTransactionsController@index')->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionsController@details')->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionsController@update')->name('dashboard-transaction-update');
    
    Route::get('/dashboard/profile', 'DashboardProfileController@account')->name('dashboard-profile');
    Route::post('/dashboard/update/{redirect}', 'DashboardProfileController@update')->name('dashboard-settings-redirect');
    Route::get('/dashboard/getCity/{id}', 'DashboardProfileController@getCity')->name('dashboard-profile-get-city');


});

// 
// Route::get('/transaction/{id}', 'DashboardController@details')->name('admin-dashboard-details');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('user', 'UserController');
        // Route::resource('product', 'ProductController');

        Route::get('product', 'ProductController@index')->name('dashboard-product');
        Route::get('product/create', 'ProductController@create')->name('dashboard-product-create');
        Route::post('product/', 'ProductController@store')->name('dashboard-product-store');
        Route::delete('product/{id}', 'ProductController@destroy')->name('dashboard-product-delete');
        Route::get('product/{id}', 'ProductController@details')->name('dashboard-product-details');
        Route::post('product/{id}', 'ProductController@update')->name('dashboard-product-update');
        
        Route::post('product/gallery/upload', 'ProductController@uploadGallery')->name('dashboard-product-gallery-upload');
        Route::get('product/gallery/delete/{id}', 'ProductController@deleteGallery')->name('dashboard-product-gallery-delete'); 

        Route::resource('product-gallery', 'ProductGalleryController');
        
        Route::resource('transaction', 'TransactionController');
        Route::post('/rekap', 'TransactionController@rekap')->name('rekap');
        Route::post('/transaction/filter', 'TransactionController@filter')->name('filter');
        Route::get('/transaction/excel/{dari}/{ke}', 'TransactionController@eksporExcel')->name('excel.ekspor');
        Route::get('/transaction/getDataRekap/{dari}/{ke}', 'TransactionController@getDataRekapBulanan');
        
    });

Auth::routes();

