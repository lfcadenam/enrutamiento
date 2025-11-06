<?php

namespace App\Controllers;

class Controller
{
    public function view($route, $data = []){

        //destructuring de array asociativo
        extract($data);        

        $route = str_replace('.','/',$route);
        
        if(file_exists("../resources/Views/{$route}.php")) {
            ob_start();
            include "../resources/Views/{$route}.php";
            $content = ob_get_clean();

            return $content;

        } else {
            return "View not found";
        }
    }
}