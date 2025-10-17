<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Organizador Escolar - Inicio',
            'page' => 'home'
        ];
        
        return view('home/home', $data);
    }
}