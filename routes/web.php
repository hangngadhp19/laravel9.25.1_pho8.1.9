<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\EditingController;
use App\Http\Controllers\EmailController;

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

Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::post('/admin/login', [AdminController::class, 'loginPost'])->name('admin.loginPost');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
	Route::get('/admin/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
	Route::get('/admin/listing/{model}', [ListingController::class, 'index'])->name('listing.index');
	Route::get('/admin/editing/{model}', [EditingController::class, 'create'])->name('editing.create');
	Route::post('/admin/editing/{model}', [EditingController::class, 'store'])->name('editing.store');
	Route::delete('/admin/editing/{model}/{id}', [EditingController::class, 'destroy'])->name('editing.destroy')->where('id', '[0-9]{1,30}');
	Route::get('/admin/editing/{model}/{id}', [EditingController::class, 'edit'])->name('editing.edit')->where('id', '[0-9]{1,30}');
	Route::patch('/admin/editing/{model}/{id}', [EditingController::class, 'update'])->name('editing.update')->where('id', '[0-9]{1,30}');
	
	Route::get('/admin/send-email/{model}/{id}', [EmailController::class, 'send'])->name('email.send')->where('id', '[0-9]{1,30}');
	Route::patch('/admin/send-email/{model}/{id}/{status}', [EmailController::class, 'update'])->name('email.update')->where('id', '[0-9]{1,30}');
	
});
