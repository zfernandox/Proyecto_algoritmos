<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'password', 'tipo', 'estado', 'foto_perfil', 'email_verificado', 'token_verificacion'];
    protected $useTimestamps = false;
    

    public function getUsuarioByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
    
}