<?php

namespace App\Controllers;

class CheckoutController extends Controller
{
    public function Checkout($paremtro = null)
    {
        return $this->view('Checkout', [
            'cantidad' => $paremtro
        ]);
    }    
}