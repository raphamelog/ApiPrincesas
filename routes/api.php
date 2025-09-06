<?php

use App\Http\Controllers\PrincesasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){return response()->json(['Sucesso'=>true]);});
Route::get('/princesas',[PrincesasController::class,'index']);
Route::get('/princesas/{codigo}',[PrincesasController::class,'show']);

Route::post('/princesas',[PrincesasController::class,'store']);

Route::put('/princesas/{codigo}',[PrincesasController::class, 'update']);

Route::delete('/princesas/{id}',[PrincesasController::class, 'destroy']); 
