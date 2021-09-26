<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('generate-url',         [ShortUrlController::class, 'store']);
Route::put('generate-url/{id}',     [ShortUrlController::class, 'update']);
Route::delete('generate-url/{id}',  [ShortUrlController::class, 'destroy']);
Route::get('generate-url',          [ShortUrlController::class, 'list']);
