<?php

namespace App\Models;

use mysqli;

class Numeros extends Model
{   
    protected $table = 'ventas';

    public static function generarNumeroAleatorio($longitud = 4)
    {
        $caracteres = '0123456789';
        $numeroAleatorio = '';

        for ($i = 0; $i < $longitud; $i++) {
            $indice = rand(0, strlen($caracteres) - 1);
            $numeroAleatorio .= $caracteres[$indice];
        }

        return $numeroAleatorio;
    }
}