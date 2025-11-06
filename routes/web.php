<?php

use Libreria\Route;

use App\Controllers\HomeController;
use App\Controllers\CheckoutController;
use App\Controllers\ConsultarNumeros;

Route::get('/', [HomeController::class, 'index']);
Route::get('/:cantidad', [CheckoutController::class, 'Checkout']);
Route::get('/consultar-numeros', [ConsultarNumeros::class, 'ConsultaNumeros']);

/*
Route::get('/consulta-numeros', function () {    
    require 'consulta-numeros.php';
});

Route::get('/:cantidad', function($cant) {
    $cantidad = $cant;    
    require_once 'formulario.php';
});*/

Route::dispatch();