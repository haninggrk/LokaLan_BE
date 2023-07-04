<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('words', [WordController::class, 'index']);
Route::post('words', [WordController::class, 'store']);
Route::get('words/{id}', [WordController::class, 'show']);
Route::put('words/{id}', [WordController::class, 'update']);
Route::delete('words/{id}', [WordController::class, 'destroy']);