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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/event', 'HomeController@eventPage')->name('event');
Route::post('/cart-add-event/{id}', 'CartController@addEvent')->middleware('auth')->name('cart.addEvent');
Route::post('/cart-add-product/{id}', 'CartController@addProduct')->middleware('auth')->name('cart.addProduct');
Route::get('/marketplace', 'HomeController@marketPage')->name('marketplace');
Route::get('/product/{id}', 'HomeController@detailProduct')->name('detail.product');
Route::get('event/{id}', 'HomeController@detailEvent')->name('detail.event');
Route::get('/about-us', 'HomeController@aboutusPage')->name('about-us');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');

Route::group(['prefix' => 'cart', 'middleware' => 'auth'], function () {
    Route::get('/', 'CartController@index')->name('cart');
    Route::post('/checkout', 'CheckoutController@checkout')->name('post.checkout');
    Route::post('/update-cart', 'CartController@updateCart')->name('cart.update');
    Route::post('/update-product-cart', 'CartController@updateCart')->name('cart.product-update');
    Route::post('/delete-cart-item', 'CartController@deleteItem')->name('cart.destroy');
    Route::delete('delete/{id}', 'CartController@destroy')->name('cart.delete');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/profile', 'UserController@profilePage')->name('profile');
    Route::post('/update-profile', 'UserController@update')->name('update.profile');
    Route::post('/upload-avatar', 'UserController@changeImageProfile')->name('image.profile');
    Route::get('/profile-image', 'UserController@getImageProfile')->name('profile-image');
    Route::get('/information-membership', 'UserController@membershipPage')->name('membership');
    Route::get('/membership', 'UserController@userMembership')->name('detail-membership');
    Route::get('/register-membership', 'UserController@registerPage')->name('register-membership');
    Route::get('/payment', 'UserController@payMembership')->name('pay-membership');
    Route::get('/edit-membership', 'UserController@editMembership')->name('edit-membership');
    Route::get('/history-payment', 'UserController@historyPayment')->name('history-membership');
    Route::post('/pay-membership', 'UserController@paymentMembership')->name('payment');
    Route::post('/store-membership', 'UserController@registerMembership')->name('store-membership');
    Route::put('/update-membership', 'UserController@updateMembership')->name('update-membership');
    Route::post('/change-password', 'UserController@changePassword')->name('change-password');

    Route::resource('/transaction', 'Dashboard\TransactionController');

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::put('/update/{id}', 'ProductController@update')->name('product.update');
        Route::delete('delete/{id}', 'ProductController@destroy')->name('product.delete');
    });
    
    Route::resource('ads', 'AdsController');
});

Route::group(['prefix' => 'admin-dashboard', 'middleware' => 'admin'], function () {
    Route::get('/candidate', 'Admin\MembershipController@membershipCandidate')->name('membership.candidate');
    Route::get('/membership', 'Admin\MembershipController@membershipReal')->name('membership.real');
    Route::get('/list-payment', 'Admin\MembershipController@paymentList')->name('membership.transaction');
    Route::get('/change-status/{id}', 'Admin\MembershipController@changeStatusActive')->name('membership.setStatus');

    Route::group(['prefix' => 'event'], function () {
        Route::get('/', 'Admin\EventController@index')->name('event.index');
        Route::get('/create', 'Admin\EventController@create')->name('event.create');
        Route::post('store', 'Admin\EventController@store')->name('event.store');
        Route::get('/edit/{id}', 'Admin\EventController@edit')->name('event.edit');
        Route::put('/update/{id}', 'Admin\EventController@update')->name('event.update');
        Route::delete('delete/{id}', 'Admin\EventController@destroy')->name('event.delete');
    });

    Route::get('/admin-ads', 'AdsController@indexAdmin')->name('ads.admin');
    Route::get('/ads-status/{id}', 'AdsController@changeStatusActive')->name('ads.status');
    Route::resource('content', 'ContentController');
});

Route::get('/getProvinces', 'UserController@getProvince')->name('province');
Route::get('/getCity/{id}', 'UserController@getCities')->name('city');
Route::get('/success', 'CartController@success')->name('success');
Route::get('/ongkir', 'CartController@check_ongkir');
