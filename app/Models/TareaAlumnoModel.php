<?php
// app/Models/TareaAlumnoModel.php
namespace App\Models;

use CodeIgniter\Model;

class TareaAlumnoModel extends Model
{
    protected $table = 'tareas_alumnos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tarea_id', 'alumno_id', 'estado', 'calificacion', 'fecha_entrega',
        'archivo_entrega', 'comentario_entrega', 'fecha_entrega_envio',
        'comentario_calificacion', 'fecha_calificacion'
    ];
    protected $useTimestamps = false;

    public function getTareasByAlumno($alumno_id)
    {
        return $this->select('tareas.*, tareas_alumnos.estado as estado_asignacion, tareas_alumnos.calificacion, tareas_alumnos.comentario_calificacion, tareas_alumnos.fecha_calificacion')
                   ->join('tareas', 'tareas.id = tareas_alumnos.tarea_id')
                   ->where('tareas_alumnos.alumno_id', $alumno_id)
                   ->findAll();
    }

    // Obtener entregas pendientes de calificar para un profesor
    public function getEntregasPendientesCalificacion($profesor_id)
    {
        return $this->select('tareas_alumnos.*, tareas.título, tareas.descripción, usuarios.nombre as alumno_nombre, usuarios.email as alumno_email')
                   ->join('tareas', 'tareas.id = tareas_alumnos.tarea_id')
                   ->join('usuarios', 'usuarios.id = tareas_alumnos.alumno_id')
                   ->where('tareas.profesor_id', $profesor_id)
                   ->where('tareas_alumnos.estado', 'entregada')
                   ->where('tareas_alumnos.calificacion IS NULL')
                   ->findAll();
    }

    // Calificar una entrega
    public function calificarEntrega($entrega_id, $calificacion, $comentario)
    {
        $data = [
            'calificacion' => $calificacion,
            'comentario_calificacion' => $comentario,
            'fecha_calificacion' => date('Y-m-d H:i:s'),
            'estado' => 'calificada'
        ];
        
        return $this->update($entrega_id, $data);
    }

    // Obtener estadísticas de calificaciones
    public function getEstadisticasCalificaciones($profesor_id)
    {
        return $this->select('COUNT(*) as total_entregas, 
                         ROUND(AVG(calificacion), 2) as promedio_general,
                         COUNT(CASE WHEN calificacion IS NOT NULL THEN 1 END) as total_calificadas')
               ->join('tareas', 'tareas.id = tareas_alumnos.tarea_id')
               ->where('tareas.profesor_id', $profesor_id)
               ->where('tareas_alumnos.estado', 'entregada')
               ->first();
    }

    // Obtener tareas calificadas de un alumno
    public function getTareasCalificadasByAlumno($alumno_id)
    {
        return $this->select('tareas.*, tareas_alumnos.calificacion, tareas_alumnos.comentario_calificacion, tareas_alumnos.fecha_calificacion')
               ->join('tareas', 'tareas.id = tareas_alumnos.tarea_id')
               ->where('tareas_alumnos.alumno_id', $alumno_id)
               ->where('tareas_alumnos.estado', 'calificada')
               ->where('tareas_alumnos.calificacion IS NOT NULL')
               ->orderBy('tareas_alumnos.fecha_calificacion', 'DESC')
               ->findAll();
    }

    // Obtener estadísticas para alumno
    public function getEstadisticasAlumno($alumno_id)
    {
        return $this->select('COUNT(*) as total_tareas,
                         COUNT(CASE WHEN estado = "asignada" THEN 1 END) as tareas_pendientes,
                         COUNT(CASE WHEN estado = "entregada" THEN 1 END) as tareas_entregadas,
                         COUNT(CASE WHEN estado = "calificada" THEN 1 END) as tareas_calificadas,
                         ROUND(AVG(calificacion), 2) as promedio_general')
               ->where('alumno_id', $alumno_id)
               ->first();
    }
}