<?php

use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashbordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCatalogueController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;

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
// trang login, sử dụng middleware để để ktra  // ĐẶT TÊN CHO ROUTE
Route::get('admin',[AuthController::class,'index'])->name('auth.admin')->middleware(LoginMiddleware::class);

// Xử lý form login sau khi bấm đăng nhập
Route::post('login',[AuthController::class,'login'])->name('auth.login');

// Xử lý tính năng logout
Route::get('logout',[AuthController::class,'logout'])->name('auth.logout');

// Xử lý giao diện dashboard  nếu đã đăng xuất thì k thể vào lại trang dashboard bằng /dashboard 
Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard.index')->middleware('admin');

// GROUP USER 
// Route dùng để QL thành viên user, middleware 'admin' thì đã khai báo trong file kernel
Route::group(['prefix' => 'user'],function(){
    Route::get('index',[UserController::class,'index'])->name('user.index')->middleware('admin');
    
    Route::get('create',[UserController::class,'create'])->name('user.create')->middleware('admin');

    // xử lý thêm user
    Route::post('store',[UserController::class,'store'])->name('user.store')->middleware('admin');

    // Edit user
    Route::get('{id}/edit',[UserController::class,'edit'])->where(['id' => '[0-9]+'])->name('user.edit')->middleware('admin');

    // Update user
    Route::post('{id}/update',[UserController::class,'update'])->where(['id' => '[0-9]+']) ->name('user.update')->middleware('admin');

    //chuyển sang trang xác nhận delete user
    Route::get('{id}/delete',[UserController::class,'delete'])->where(['id' => '[0-9]+']) ->name('user.delete')->middleware('admin');

    // xử lý xóa user
    Route::delete('{id}/destroy',[UserController::class,'destroy'])->where(['id' => '[0-9]+']) ->name('user.destroy')->middleware('admin');

});


// GROUP QUẢN LÝ THÀNH VIÊN
Route::group(['prefix' => 'user/catalogue'],function(){
    Route::get('index',[UserCatalogueController::class,'index'])->name('user.catalogue.index')->middleware('admin');
    
    Route::get('create',[UserCatalogueController::class,'create'])->name('user.catalogue.create')->middleware('admin');

    // xử lý thêm user
    Route::post('store',[UserCatalogueController::class,'store'])->name('user.catalogue.store')->middleware('admin');

    // Edit user
    Route::get('{id}/edit',[UserCatalogueController::class,'edit'])->where(['id' => '[0-9]+'])->name('user.catalogue.edit')->middleware('admin');

    // Update user
    Route::post('{id}/update',[UserCatalogueController::class,'update'])->where(['id' => '[0-9]+']) ->name('user.catalogue.update')->middleware('admin');

    //chuyển sang trang xác nhận delete user
    Route::get('{id}/delete',[UserCatalogueController::class,'delete'])->where(['id' => '[0-9]+']) ->name('user.catalogue.delete')->middleware('admin');

    // xử lý xóa user
    Route::delete('{id}/destroy',[UserCatalogueController::class,'destroy'])->where(['id' => '[0-9]+']) ->name('user.catalogue.destroy')->middleware('admin');

});


//  AJAX    
Route::get('ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.index')->middleware('admin');
Route::post('ajax/dashboard/changeStatus',[AjaxDashbordController::class,'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware('admin');
Route::post('ajax/dashboard/changeStatusAll',[AjaxDashbordController::class,'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware('admin');

