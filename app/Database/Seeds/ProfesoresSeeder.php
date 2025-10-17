<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfesoresSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            "nombre"=> "profesor Jorge",
            "email"=> "jorge@gmail.com",
            "contraseña"=> "1212"
            ],
            [
            "nombre"=> "profesor Ana",
            "email"=> "ana@gmail.com",
            "contraseña"=> "1213"
            ]
        
        ];
        $this->db->table("profesores")->insertBatch($data);
    }
}
