<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoverController;

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

Route::prefix('rovers')->group(function(){
    Route::get('/', [RoverController::class, 'index']);
    Route::post('/', [RoverController::class, 'store']);
    Route::get('/{rover}', [RoverController::class, 'show']);
    Route::patch('/{rover}', [RoverController::class, 'update']);
});
