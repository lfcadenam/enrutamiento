<?php

use Libreria\Route;

Route::get('/5', function () {
    $cantidad = 5;
    require 'formulario.php';
});
Route::get('/10', function () {
    $cantidad = 10;
    require 'formulario.php';
});

Route::get('/6', function () {
    $cantidad = 6;
    require 'formulario.php';
});

Route::dispatch();