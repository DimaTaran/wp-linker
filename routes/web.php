<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\CdnController;
use App\Http\Controllers\WpCredentialController;


Route::get('/', function () {
    return view('welcome');
});

// Sites - Resource routes (CRUD)
Route::resource('sites', SiteController::class);

Route::get('sites-search', [SiteController::class, 'search'])
    ->name('sites.search');
