<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
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

Route::get('/csv', CSVController::class);
Route::get('/train', TrainingController::class);
Route::get('/', fn () => view('main'));

Route::resource('user', UserController::class);

Route::resource('test', TestController::class)->only(['index', 'store']);
Route::resource('course', CourseController::class);
Route::resource('expert', ExpertController::class);
