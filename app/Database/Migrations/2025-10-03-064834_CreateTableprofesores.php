<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableprofesores extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=> [
                "type"=> "INT",
                "constraint" => 9,
                "auto_increment" => true

            ],
            "nombre"=> [
                "type"=> "VARCHAR",
                "constraint" => 100,
            ],
            "email"=> [
                "type"=> "VARCHAR",
                "constraint" => 100,
            ],
            "contraseña"=> [
                "type"=> "VARCHAR",
                "constraint" => 100,
            ]
        ]);
        $this->forge->addKey("id", true );
        $this->forge->createTable("profesores");
    }

    public function down()
    {
        $this->forge->dropTable("profesores");
    }
}
