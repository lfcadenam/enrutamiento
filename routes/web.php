<?php

use Libreria\Route;
use App\Controllers\HomeController;

Route::get('/', function () {
    return HomeController::class;
});

Route::get('/consulta-numeros', function () {    
    require 'consulta-numeros.php';
});

Route::get('/:cantidad', function($cant) {
    $cantidad = $cant;    
    require 'formulario.php';
});

Route::dispatch();