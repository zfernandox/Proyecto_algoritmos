<?php
// app/Controllers/CalificacionController.php
namespace App\Controllers;

use App\Models\TareaAlumnoModel;
use App\Models\UsuarioModel;

class CalificacionController extends BaseController
{
    public function listarEntregas()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'profesor') {
            return redirect()->to('/dashboard');
        }

        $tareaAlumnoModel = new TareaAlumnoModel();
        $usuarioModel = new UsuarioModel();
        
        // Obtener todas las tareas entregadas de los alumnos del profesor
        $entregas = $tareaAlumnoModel->select('tareas_alumnos.*, tareas.título, tareas.descripción, usuarios.nombre as alumno_nombre')
                                   ->join('tareas', 'tareas.id = tareas_alumnos.tarea_id')
                                   ->join('usuarios', 'usuarios.id = tareas_alumnos.alumno_id')
                                   ->where('tareas.profesor_id', session()->get('user_id'))
                                   ->where('tareas_alumnos.estado', 'entregada')
                                   ->findAll();

        $data = [
            'title' => 'Tareas Entregadas - Calificar',
            'entregas' => $entregas
        ];

        return view('profesor/calificar', $data);
    }

    public function calificar($entrega_id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'profesor') {
            return redirect()->to('/dashboard');
        }

        $tareaAlumnoModel = new TareaAlumnoModel();
        
        // Obtener la entrega con información completa
        $entrega = $tareaAlumnoModel->select('tareas_alumnos.*, tareas.título, tareas.descripción, usuarios.nombre as alumno_nombre')
                                  ->join('tareas', 'tareas.id = tareas_alumnos.tarea_id')
                                  ->join('usuarios', 'usuarios.id = tareas_alumnos.alumno_id')
                                  ->where('tareas_alumnos.id', $entrega_id)
                                  ->where('tareas.profesor_id', session()->get('user_id'))
                                  ->first();

        if (!$entrega) {
            return redirect()->to('/calificaciones')->with('error', 'Entrega no encontrada.');
        }

        $data = [
            'title' => 'Calificar Tarea',
            'entrega' => $entrega
        ];

        return view('profesor/calificar_form', $data);
    }

    public function guardarCalificacion($entrega_id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'profesor') {
            return redirect()->to('/dashboard');
        }

        $tareaAlumnoModel = new TareaAlumnoModel();
        
        $datosCalificacion = [
            'calificacion' => $this->request->getPost('calificacion'),
            'comentario_calificacion' => $this->request->getPost('comentario_calificacion'),
            'estado' => 'calificada',
            'fecha_calificacion' => date('Y-m-d H:i:s')
        ];

        // Actualizar la calificación
        $tareaAlumnoModel->update($entrega_id, $datosCalificacion);

        session()->setFlashdata('success', '✅ Calificación guardada exitosamente.');
        return redirect()->to('/calificaciones');
    }
}