<?php

namespace App\Controllers;

use App\Models\Numeros;

class ConsultarNumeros extends Controller
{
    public function ConsultaNumeros($paremtro = null)
    {   
        $numerdosModel = new Numeros();

        return $numerdosModel->where('correo_comprador','=','luisferdeveloper@gmail.com')->get();

        return $this->view('ConsultaNumeros', [
            'title'=>'Consulta Números',
            'descripcion'=>'Página de consulta de números'
        ]);
    }    
}