<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SoftSkillController;
use Illuminate\Support\Facades\Route;

Route::get('/about', [AboutController::class, 'index']);
Route::get('/experience', [ExperienceController::class, 'index']);
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/softskills', [SoftSkillController::class, 'index']);
Route::get('/hobbies', [HobbyController::class, 'index']);
Route::get('/', [AboutController::class, 'index']);
