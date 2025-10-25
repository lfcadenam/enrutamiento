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

Route::get('/15', function () {
    $cantidad = 15;
    require 'formulario.php';
});

Route::get('/:cantidad', function() {    
    echo "prueba generico";
});

Route::dispatch();