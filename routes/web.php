<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    //Admin Login Route
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::group(['middleware' => ['admin']], function () {
        //Admin Dashboard Route
        Route::get('dashboard', 'AdminController@dashboard');

        //Update Admin Password
        Route::match(['get','post'],'update-admin-password','AdminController@updateAdminPassword');

        //Check Admin Password
        Route::post('check-admin-password','AdminController@checkAdminPassword');

        //Update Admin Details
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');

        //Update Vendor Details
        Route::match(['get','post'],'update-vendor-details/{slug}','AdminController@updateVendorDetails');

        //View Admins / Subadmins / Vendors
        Route::get('admins/{type?}','AdminController@admins');

        //View Vendor Details
        Route::get('view-vendor-details/{id}','AdminController@viewVendorDetails');

        // Update Admin Status
        Route::post('update-admin-status','AdminController@updateAdminStatus');

        //Admin Logout
        Route::get('logout', 'AdminController@logout');

        //Sections
        Route::get('sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        Route::get('delete-section/{id}','SectionController@deleteSection');
        Route::match(['get','post'],'add-edit-section/{id?}','SectionController@addEditSection');

        //Brands
        Route::get('brands', 'BrandController@brands');
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');

        //Categories
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
        Route::get('append-categories-level','CategoryController@appendCategoryLevel');
        Route::get('delete-category/{id}','CategoryController@deleteCategory');
        Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');

        //Products
        Route::get('products', 'ProductsController@products');
        Route::post('update-product-status', 'ProductsController@updateProductStatus');
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductsController@addEditProduct');
        Route::get('delete-product-image/{id}','ProductsController@deleteProductImage');
        Route::get('delete-product-video/{id}','ProductsController@deleteProductVideo');

        //Attributes
        Route::match(['get','post'],'add-edit-attributes/{id}','ProductsController@addAttributes');
        Route::post('update-attribute-status', 'ProductsController@updateAttributeStatus');
        Route::get('delete-attribute/{id}', 'ProductsController@deleteAttribute');
        Route::match(['get', 'post'],'edit-attributes/{id}', 'ProductsController@editAttributes');
        //Filters
        Route::get('filters', 'FilterController@filters');
        Route::get('filters-values', 'FilterController@filtersValues');
        Route::post('update-filter-status', 'FilterController@updateFilterStatus');
        Route::post('update-filter-value-status', 'FilterController@updateFilterValueStatus');
        Route::match(['get', 'post'],'add-edit-filter/{id?}','FilterController@addEditFilter');
        Route::match(['get', 'post'],'add-edit-filter-value/{id?}','FilterController@addEditFilterValue');
        Route::post('category-filters','FilterController@categoryFilters');
        Route::get('category-filters', 'FilterController@categoryFilters');

        //Images
        Route::match(['get', 'post'], 'add-images/{id}', 'ProductsController@addImages');
        Route::post('update-image-status', 'ProductsController@updateImageStatus');
        Route::get('delete-image/{id}', 'ProductsController@deleteImage');
        //Banners
        Route::get('banners', 'BannersController@banners');
        Route::post('update-banner-status', 'BannersController@updateBannerStatus');
        Route::get('delete-banner/{id}', 'BannersController@deleteBanner');
        Route::match(['get','post'],'add-edit-banner/{id?}', 'BannersController@addEditBanner');
        Route::get('add-edit-product/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'addEditProduct'])->name('admin.add.edit.product');
        Route::get('/tshirts', [ProductsController::class, 'listing']);
        //Coupons
        Route::get('coupons', 'CouponsController@coupons');
        Route::post('update-coupon-status', 'CouponsController@updateCouponStatus');
        Route::get('delete-coupon/{id}', 'CouponsController@deleteCoupon');
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', 'CouponController@addEditCoupon');
        //Users
        Route::get('users', 'UserController@users');
        Route::post('update-user-status', 'UserController@updateUserStatus');
        //CMS Pages
        Route::get('cms-pages', 'CmsController@cmspages');
        Route::post('update-cms-page-status', 'CmsController@updatePageStatus');
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', 'CmsController@addEditCmsPage');
        Route::get('delete-page/{id}', 'CmsController@deletePage');
        //Orders
        Route::get('orders', 'OrderController@orders');
        
    });
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/','IndexController@index');

   // Listing/Categories Routes
   $catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
//    dd($catUrls);die;
   foreach ($catUrls as $key => $url) {
       Route::match(['get','post'],'/'.$url, 'ProductsController@listing');
   }

   //Vendor Products
    Route::get('/products/{vendorid}','ProductsController@vendorListing');

   //Product Detail Page
    Route::get('/product/{id}','ProductsController@detail');

    // Get Product Attribute Price
    Route::post('get-product-price','ProductsController@getProductPrice');

   //Vendor Login/Register
   Route::get('vendor/login-register','VendorController@loginRegister');

   //Vendor Register
   Route::post('vendor/register', 'VendorController@vendorRegister');

   //Confirm Vendor Account
    Route::get('vendor/confirm/{code}', 'VendorController@confirmVendor');

   //Add to Cart Route
   Route::post('cart/add','ProductsController@cartAdd');

   //Cart Route
   Route::get('cart','ProductsController@cart');

   //Update Cart Item Quantity
   Route::post('cart/update','ProductsController@cartUpdate');

   //Delete Cart Item
   Route::post('cart/delete','ProductsController@cartDelete');

   //User Login/Register
   Route::get('user/login-register', ['as'=>'login','uses'=>'UserController@loginRegister']);

   //User Register
   Route::post('user/register', 'UserController@userRegister');


   Route::group(['middleware'=>['auth']],function(){
       //User Account
       Route::match(['GET', 'POST'], 'user/account', 'UserController@userAccount');
       //User Update Password
       Route::post('user/update-password', 'UserController@userUpdatePassword');
       //Apply Coupon
       Route::post('/apply-coupon','ProductsController@applyCoupon');
       //Checkout
       Route::match(['GET','POST'],'/checkout','ProductsController@checkout');
       //Get Delivery Address
       Route::post('get-delivery-address','AddressController@getDeliveryAddress');
       //Save Delivery Address
       Route::post('save-delivery-address','AddressController@saveDeliveryAddress');
       //Remove Delivery Address
       Route::post('remove-delivery-address','AddressController@removeDeliveryAddress');
       //Thanks
       Route::get('thanks','ProductsController@thanks');
       //Users Orders
       Route::get('user/orders/{id?}','OrderController@orders');
   });
    //User Login
    Route::post('user/login', 'UserController@userLogin');

    //User Forgot Password
    Route::match(['get','post'],'user/forgot-password', 'UserController@forgotPassword');

    //User Logout
    Route::get('user/logout', 'UserController@userLogout'); 

    //Confirm User Account
    Route::get('user/confirm/{code}', 'UserController@confirmAccount');

});


Route::get('/swagger', function () {
    return view('vendor.darkaonline.l5-swagger.index');
});


