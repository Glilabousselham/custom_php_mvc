<?php

namespace App\Core;

class App
{
    public function __construct()
    {
        echo Route::run();
    }
}
