<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\invoices_attachmentController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\sections;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionsController;
use App\Models\Invoices;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\UserController;
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
Route::get('/', function () {
    if(Auth::check()){
        return redirect('/home');
    }else{
        return view('auth.login');
    }

});






Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);



});





Route::resource('invoices','App\Http\Controllers\InvoicesController');

Route::resource('InvoicesArchive','App\Http\Controllers\InvoicesArchiveController');

Route::get('sections/{id}',[InvoicesController::class,'getproduct']);

Route::resource('sections','App\Http\Controllers\SectionsController');

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);

Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::get('invoicesdetails/{id}',[InvoicesDetailsController::class,'edit']);

Route::resource('InvoiceAttachment','App\Http\Controllers\invoices_attachmentController');

Route::get('edit_invoice/{id}',[InvoicesController::class,'edit']);

Route::get('status_show/{id}',[InvoicesController::class,'show']);

Route::post('update_status/{id}',[InvoicesController::class,'update_status']);

Route::get('unpaid_invoices',[InvoicesController::class,'unpaid_invoices']);

Route::get('partial_paid',[InvoicesController::class,'partial_paid']);

Route::get('/archieve',[InvoicesArchiveController::class,'index']);

Route::get('paid_invoices',[InvoicesController::class,'paid_invoices']);

Route::resource('products','App\Http\Controllers\ProductsController');

Route::get('/print_invoice/{id}',[InvoicesController::class,'print_invoice']);

Route::get('export_invoices',[InvoicesController::class,'export']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{page}', [AdminController::class,'index']);
