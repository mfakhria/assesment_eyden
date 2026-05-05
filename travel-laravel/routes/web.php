<?php

use App\Http\Controllers\CmsController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class)->name('landing');
Route::get('/cms', [CmsController::class, 'edit'])->name('cms.edit');
Route::put('/cms', [CmsController::class, 'update'])->name('cms.update');
