<?php

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

/** Route::get('/', function () {
    return view('welcome');
});*/

use App\Http\Controllers\CouponsController;

Route::get('/','IndexController@index');

// listing pages
Route::get('/products/{url}', 'ProductController@Products');
//product
Route::get('/product/{id}','ProductController@product');
//attribute-price
Route::get('/get-product-price','ProductController@getAttrPrice');
//add to cart
Route::match(['get', 'post'], '/add-to-cart', 'ProductController@addToCart');
//delete from cart
Route::get('/delete-product-cart/{id}','ProductController@deletePcart');
//update cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductController@updateQuantity');
//coupon

Route::post('/cart/apply-code','ProductController@applyCode');
Route::match(['get', 'post'], '/admin', 'AdminController@login');
Route::match(['get', 'post'], '/cart', 'ProductController@Cart');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//User

Route::match(['get', 'post'], '/check-email', 'UsersController@checkEmail');
Route::get('/login-register', 'UsersController@userLoginRegister');
Route::post('/user-register','UsersController@register');
Route::post('/user-login','UsersController@login');
Route::get('/user-logout','UsersController@logout');
Route::group(['middleware' => ['FrontLogin']], function () {
    Route::match(['get', 'post'], '/account', 'UsersController@account');
    Route::post('/check-pass','UsersController@checkpass');
    Route::post('/update-pass','UsersController@updatepass');
    //checkout Product
    Route::match(['get', 'post'], '/checkout','ProductController@checkout');
    Route::match(['get', 'post'], '/order-review','ProductController@orderReview');
});


  Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/dashbord','AdminController@dashbord');
    Route::get('/admin/setting','AdminController@setting');
    Route::get('/admin/chek_pwd','AdminController@checkpwd');
    Route::match(['get', 'post'], '/admin/update_pwd', 'AdminController@updatePwd');
    //CategoryCOntroller
    Route::match(['get', 'post'], '/admin/add-category','CategoryController@addCategory');
    Route::get('/admin/view-category','CategoryController@viewCategories');
    Route::match(['get', 'post'], '/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}','CategoryController@deleteCategory');
    //product
    Route::match(['get', 'post'], '/admin/add-product','ProductController@addProduct');
    Route::get('/admin/view-product','ProductController@viewProducts');
    Route::match(['get', 'post'], '/admin/edit-product/{id}','ProductController@editProduct');
    Route::get('admin/delete-image/{id}', 'ProductController@deleteImage');
    Route::get('admin/delete-product/{id}', 'ProductController@deleteProduct');
    Route::get('admin/delete-alt-image/{id}', 'ProductController@deletealtProduct');

    //attribute-product
    Route::match(['get', 'post'], '/admin/add-attribute/{id}', 'ProductController@addAttribute');
    Route::match(['get', 'post'], '/admin/edit-attribute/{id}', 'ProductController@editAttribute');
    Route::match(['get', 'post'], '/admin/add-image/{id}', 'ProductController@addImages');
    Route::get('admin/delete-attribute/{id}', 'ProductController@deleteAttribute');
// Coupon
    Route::match(['get', 'post'], '/admin/add-coupon','CouponsController@addCoupon');
    Route::get('/admin/view-coupon','CouponsController@viewCoupons');
    Route::match(['get', 'post'], '/admin/edit-coupon/{id}','CouponsController@editCoupon' );
    Route::get('/delete-coupon/{id}','CouponsController@deleteCoupon');
     // admin Banner
    Route::match(['get', 'post'],'/admin/add-banner', 'BannerController@addBanner');
    Route::get('/admin/view-banner', 'BannerController@viewBanner');
    Route::match(['get', 'post'],'/admin/add-banner', 'BannerController@addBanner');
    Route::match(['get', 'post'], '/admin/edit-banner/{id}', 'BannerController@editBanner');
    Route::get('/admin/delete-banner/{id}', 'BannerController@deleteBanner');
    });

Route::get('/logout','AdminController@logout');
