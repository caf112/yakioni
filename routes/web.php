<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GmailController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/articles', ArticleController::class);
    Route::resource('/companys', CompanyController::class);
});

Route::get('auth/google', [GmailController::class, 'redirectToGoogle']);
Route::get('callback', [GmailController::class, 'handleGoogleCallback']);