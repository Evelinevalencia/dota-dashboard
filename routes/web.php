<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;

Route::get('/', [HeroController::class, 'index']);
Route::get('/hero-stats', [HeroController::class, 'heroStats']);
Route::get('/meta-suggestions', [HeroController::class, 'metaSuggestions']);
Route::get('/pro-suggestions', [HeroController::class, 'proSuggestions']);
Route::get('/player/{id}', [HeroController::class, 'playerSuggestions']);
Route::post('/player/suggestions', [HeroController::class, 'createplayerSuggestions']);

