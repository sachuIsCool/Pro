<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::post('/search', [RestaurantController::class, 'search'])->name('restaurants.search');


