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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return redirect()->route('home');
})->name('index');

Auth::routes();

Route::get('register/verify/{token}', 'Auth\RegisterController@verify');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faq', 'HomeController@faq')->name('faq');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout-get');
Route::get('/login-by-admin/{id}', 'Auth\LoginController@loginByAdmin')->name('login-by-admin');

Route::get('/user/update', 'HomeController@getUser')->name('edit-user');
Route::post('/user/update', 'HomeController@postUser')->name('update-user');

Route::get('/products', 'HomeController@getProducts')->name('products');

Route::get('/products/own-stock', 'HomeController@getProductsStock')->name('products-stock');
Route::get('/products/comp-stock', 'HomeController@getProductsStockComp')->name('products-stock-comp');

Route::get('/product/add', 'HomeController@getAddProduct')->name('create-product');
Route::post('/product/add', 'HomeController@postAddProduct')->name('add-product');

Route::get('/product/edit/{id}', 'HomeController@getEditProduct')->name('edit-product');
Route::post('/product/update', 'HomeController@postUpdateProduct')->name('update-product');
Route::get('/product/delete/{id}', 'HomeController@getDeleteProduct')->name('delete-product');
Route::get('/product/delete-comp/{id}', 'HomeController@getCompDeleteProduct')->name('product-comp-delete');
Route::post('/product/add-comp', 'HomeController@postAddProductComp')->name('add-product-comp');
Route::get('/product/history/{id}', 'HomeController@getHistoryProduct')->name('product-history');

Route::get('/categories', 'HomeController@getCategories')->name('categories');
Route::get('/category/add', 'HomeController@getAddCategory')->name('create-category');
Route::post('/category/add', 'HomeController@postAddCategory')->name('add-category');
Route::get('/category/edit/{id}', 'HomeController@getEditCategory')->name('edit-category');
Route::post('/category/update', 'HomeController@postUpdateCategory')->name('update-category');
Route::get('/category/delete/{id}', 'HomeController@getDeleteCategory')->name('delete-category');
Route::get('/category/delete-comp/{id}', 'HomeController@getCompDeleteCategory')->name('category-comp-delete');
Route::post('/category/add-comp', 'HomeController@postAddCategoryComp')->name('add-category-comp');
//Route::get('/category-delete/{id}', 'HomeController@getDeleteCategory')->name('category-delete');

Route::get('/add-batch', 'HomeController@getAddBatch')->name('create-batch');
Route::post('/add-batch', 'HomeController@postAddBatch')->name('add-batch');

Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

/* Admin Section */
Route::prefix('admin')->group(function() {

    Route::get('/account', 'AdminController@getAccount')->name('admin.account');
    Route::post('/account/update', 'AdminController@postAccount')->name('admin.account.submit');

    Route::get('/login-user/{id}', 'AdminController@getLoginUser')->name('admin.login-user');

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/packages', 'AdminController@getPackages')->name('admin.packages');
    Route::get('/package/{id?}', 'AdminController@getPackage')->name('admin.package');
    Route::post('/update-package', 'AdminController@postPackage')->name('admin.update-package');

    Route::get('/users', 'AdminController@getUsers')->name('admin.users');
    Route::get('/user/{id?}', 'AdminController@getUser')->name('admin.user');
    Route::post('/update-user', 'AdminController@postUser')->name('admin.update-user');
    Route::get('/user-suspend/{id?}', 'AdminController@getUserSuspend')->name('admin.suspend-user');

});