<?php

use App\Controllers\ContactController;
use App\Core\Route;

Route::get('/', function () {
    return view("home");
});

Route::get('contact', [ContactController::class,'index']);
