<?php

use App\Http\Controllers\TrainerController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('api')->group(function () {
    //trainer
    Route::get('/trainers', [TrainerController::class, 'index']);
    Route::get('/trainers/{id}', [TrainerController::class, 'show']);
    Route::get('/trainers/{id}/pokemon', [TrainerController::class, 'indexPokemon']);
    Route::get('/trainers/{id}/pokemon/{pokemonId}', [TrainerController::class, 'showPokemon']);
    Route::patch('/trainers/{id}', [TrainerController::class, 'update']);
    Route::post('/trainers', [TrainerController::class, 'store']);
    Route::delete('/trainers/{id}', [TrainerController::class, 'destroy']);
});
