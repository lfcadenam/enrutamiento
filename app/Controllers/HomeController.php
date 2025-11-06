<?php

namespace App\Controllers;

use App\Models\Numeros;

class HomeController extends Controller
{
    public function index()
    {       
        
        return $this->view('home', [
            'title' => 'Bienvenido a la pagina de incio uno',
            'content' => 'Pagina de inicio del modulo de pagos.'
        ]);
    }    
}
