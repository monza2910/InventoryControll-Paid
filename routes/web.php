<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\GoodMaster;
use App\Livewire\GoodIn;
use App\Livewire\Receipent;
use App\Livewire\BorrowGood;

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


// Route::resource('good', GoodController::class);
route::group([ 'middleware' => 'auth'],function(){
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('good',GoodMaster::class)->name('masterGood');
    Route::get('goodin', GoodIn::class)->name('goodIn');
    Route::get('receipent', Receipent::class)->name('receipent');
    Route::get('borrowgood', BorrowGood::class)->name('borrowGood');
});
Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
