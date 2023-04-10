<?php

use App\Http\Controllers\CSVController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrainingController;
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

// Route::get('/csv', CSVController::class);
Route::get('/train', TrainingController::class);
Route::get('/', function () {
    return view('main');
});

Route::resource('data', DataController::class);

Route::get('test', [TestController::class, 'index'])->name('test.index');
Route::post('test', [TestController::class, 'store'])->name('test.store');
