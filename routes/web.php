<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttatchmentController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CountryGroupController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\InboundItemController;
use App\Http\Controllers\StockController;
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

Auth::routes();

//login route
Route::post('login',[App\Http\Controllers\Auth\LoginController::class,'authanticate'])->middleware('App\Http\Middleware\checkStatus:true')->name('authanticate');

Route::get('password/reset/{token}','App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->middleware('guest')->name('password.reset');

Route::group(['middleware'=> ['auth']
],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('password_email/{email}','App\Http\Controllers\Auth\ResetPasswordController@password_email'
    )->name('password.email');
    Route::post('password/update','App\Http\Controllers\Auth\ResetPasswordController@password_update')->name('password_update');
    
    // USER
    Route::resource('user', 'App\Http\Controllers\UserController');
    Route::post('password_set_user','App\Http\Controllers\UserController@password_set_user')->name('password_set_user');
    Route::get('password_set/{email}','App\Http\Controllers\UserController@password_set')->name('password_set');
    Route::get('password_setview/{email}','App\Http\Controllers\UserController@password_setview')->name('password_setview');
    
    Route::resource('category', 'App\Http\Controllers\CategoryController')->middleware('App\Http\Middleware\categorypermission:true');
    Route::post('categories_ajaxstore','App\Http\Controllers\CategoryController@ajaxstore')->name('categories_ajaxstore');
    Route::resource('product', 'App\Http\Controllers\ProductController')->middleware('App\Http\Middleware\categorypermission:true');
    Route::get('csvfileview',function(){
        return view('product\csvfileview');
    })->name('csvfileview');
    Route::post('importData','App\Http\Controllers\ProductController@importData')->name('importData');
    
    Route::get('importExcelviewProduct',function(){
        return view('product\excel_file_view');
    })->name('importExcelview');
    Route::post('importExcelData','App\Http\Controllers\ProductController@importExcelData')->name('importExcelData');
    
    Route::post('getcategoryData','App\Http\Controllers\ProductController@getcategoryData')->name('getcategoryData');
    
    Route::get('importExcelviewCategory',function(){
        return view('category\excel_file_view');
    })->name('importExcelviewCategory');
    
    Route::post('importExcelDataCategory','App\Http\Controllers\CategoryController@importExcelDataCategory')->name('importExcelDataCategory');
    Route::post('uploadAttatchment/{id}','App\Http\Controllers\AttatchmentController@store')->where('id', '[0-9]+')->name('uploadAttatchment');
    
    Route::get('download/{image_name}','App\Http\Controllers\AttatchmentController@image_download')->middleware('App\Http\Middleware\attatchmentPermission:true')->name('image_download');
    Route::get('remove/{id}','App\Http\Controllers\AttatchmentController@image_remove')->middleware('App\Http\Middleware\attatchmentPermission:true')->name('image_remove');
    Route::get('restore/{id}','App\Http\Controllers\AttatchmentController@image_restore')->middleware('App\Http\Middleware\attatchmentPermission:true')->name('image_restore');
    
    Route::get('attatchments', 'App\Http\Controllers\AttatchmentController@attachments')->name('attachments');
    Route::post('attatchments/ajaxfetch', 'App\Http\Controllers\AttatchmentController@ajaxFetchData')->name('ajaxFetchData');
    
    Route::resource('country','App\Http\Controllers\CountryController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::resource('country_group','App\Http\Controllers\CountryGroupController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::resource('region','App\Http\Controllers\RegionController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::resource('organization','App\Http\Controllers\OrganizationController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::get('organization_show','App\Http\Controllers\OrganizationController@organization_show')->name('organization_show')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/organization','App\Http\Controllers\OrganizationController@ajaxfetchorganization')->name('ajaxfetchorganization')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::resource('location','App\Http\Controllers\LocationController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::POST('ajaxuserfetch','App\Http\Controllers\LocationController@ajaxuserfetch')->name('ajaxuserfetch')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::get('location_show','App\Http\Controllers\LocationController@location_show')->name('location_show')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/location','App\Http\Controllers\LocationController@ajaxfetchlocation')->name('ajaxfetchlocation')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/location/edit','App\Http\Controllers\LocationController@ajaxuserfetchedit')->name('ajaxuserfetchedit')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::resource('donation','App\Http\Controllers\DonationController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('organization/country','App\Http\Controllers\DonationController@organization_country')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('organization_country');
    Route::post('organization/country/edit','App\Http\Controllers\DonationController@organization_country_edit')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('organization_country_edit');
    
    Route::get('download_excel_samle',function(){
        $file = public_path()."/download/donation_sample.xlsx";
        return response()->download($file,'donation_sample.xlsx');
    })->name('download_excel_samle');
    
    Route::get('donation_show','App\Http\Controllers\DonationController@donation_show')->name('donation_show')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/donation','App\Http\Controllers\DonationController@ajaxfetchdonation')->name('ajaxfetchdonation')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::resource('donation_item','App\Http\Controllers\DonationItemController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/donation-item','App\Http\Controllers\DonationItemController@ajaxfetchdonationitem')->name('ajaxfetchdonationitem')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/donation-item/edit','App\Http\Controllers\DonationItemController@ajaxfetchdonationitemedit')->name('ajaxfetchdonationitemedit')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::get('donation-item/show/{id}','App\Http\Controllers\DonationItemController@donation_item_index')->name('donation_item_index')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('ajaxfetch/donation-item/destroy','App\Http\Controllers\DonationItemController@donation_item_destroy')->name('donation_item_destroy')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('ajaxfetch/donation-item/show','App\Http\Controllers\DonationItemController@donation_item_show')->name('donation_item_show')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/donation-item/restore','App\Http\Controllers\DonationItemController@donation_item_restore')->name('donation_item_restore')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('ajaxfetch/donation-item/commit','App\Http\Controllers\DonationItemController@donation_item_commit')->name('donation_item_commit')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::resource('carriers','App\Http\Controllers\CarrierController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('add_method','App\Http\Controllers\CarrierController@add_method')->name('add_method')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('ajaxcarriermethod','App\Http\Controllers\CarrierController@ajaxcarriermethod')->name('ajaxcarriermethod')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::resource('shipment','App\Http\Controllers\ShipmentController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('carrier/method','App\Http\Controllers\ShipmentController@carrier_method_data')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('carrier_method_data');
    Route::post('carrier/method/edit','App\Http\Controllers\ShipmentController@carrier_method_dataedit')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('carrier_method_dataedit');
    
    Route::post('add/comments','App\Http\Controllers\ShipmentController@add_comments')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('add_comments');
    
    Route::post('ajax/shipment/list','App\Http\Controllers\ShipmentController@ajaxfetchshipment')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('ajaxfetchshipment');
    
    Route::get('ajax/shipment/post/{id}','App\Http\Controllers\ShipmentController@markaspost')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('markaspost');
    
    Route::resource('inbound_item','App\Http\Controllers\InboundItemController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('ajax/in-bound/product','App\Http\Controllers\InboundItemController@add_productview')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('add_productview');
    
    Route::post('ajax/product_detail_add','App\Http\Controllers\InboundItemController@product_detail_add')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('product_detail_add');
    
    Route::post('ajax/inbound_item_view','App\Http\Controllers\InboundItemController@inbound_item_view')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('inbound_item_view');
    
    Route::post('ajax/fetchinbound_itemedit','App\Http\Controllers\InboundItemController@fetchinbound_itemedit')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('fetchinbound_itemedit');
    
    Route::post('inbound_item/destroy','App\Http\Controllers\InboundItemController@inbound_item_destroy')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('inbound_item_destroy');
    
    Route::post('ajax/fetchinbound_itemshow','App\Http\Controllers\InboundItemController@fetchinbound_itemshow')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('fetchinbound_itemshow');
    
    Route::post('ajax/inbound_item_viewposted','App\Http\Controllers\InboundItemController@inbound_item_viewposted')->middleware('App\Http\Middleware\OrganizationAccess:true')->name('inbound_item_viewposted');
    
    Route::resource('stock','App\Http\Controllers\StockController')->middleware('App\Http\Middleware\OrganizationAccess:true');
    Route::post('stock/items','App\Http\Controllers\StockController@ajaxfetchsstock')->name('ajaxfetchsstock')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('stock/items/detail','App\Http\Controllers\StockController@stockitem_detail')->name('stockitem_detail')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('stock/items/adjustview','App\Http\Controllers\StockController@calladjustview')->name('calladjustview')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('stock/items/adjuststore','App\Http\Controllers\StockController@adjust_store')->name('adjust_store')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('stock/items/markashold','App\Http\Controllers\StockController@markashold')->name('markashold')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::post('stock/items/markasunhold','App\Http\Controllers\StockController@markasunhold')->name('markasunhold')->middleware('App\Http\Middleware\OrganizationAccess:true');
    
    Route::get('stock/items/view_detail/{id}','App\Http\Controllers\StockController@view_detail')->name('view_detail')->middleware('App\Http\Middleware\OrganizationAccess:true');
});


