<?php

use App\Http\Controllers\PageControler;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageControler::class, 'showHomepage']);
Route::get('/about', [PageControler::class, 'showHomepage']);
