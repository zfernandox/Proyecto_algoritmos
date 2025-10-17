<?php
namespace App\Models;

use CodeIgniter\Model;

class TareaModel extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['título', 'descripción', 'fecha_entrega', 'cestado', 'profesor_id'];
    protected $useTimestamps = false;

    public function getTareasByProfesor($profesor_id)
    {
        return $this->where('profesor_id', $profesor_id)->findAll();
    }
}