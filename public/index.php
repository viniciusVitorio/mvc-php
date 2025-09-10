<?php 

use src\Facades\Route;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/web.php';

Route::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);