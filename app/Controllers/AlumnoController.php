<?php
namespace App\Controllers;

use App\Models\TareaAlumnoModel;

class AlumnoController extends BaseController
{
    public function calificaciones()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'alumno') {
            return redirect()->to('/dashboard');
        }

        $tareaAlumnoModel = new TareaAlumnoModel();
        
        $data = [
            'title' => 'Mis Calificaciones',
            'tareas_calificadas' => $tareaAlumnoModel->getTareasCalificadasByAlumno(session()->get('user_id'))
        ];
        
        return view('alumno/calificaciones', $data);
    }
    public function misTareas()
{
    if (!session()->get('logged_in') || session()->get('role') !== 'alumno') {
        return redirect()->to('/dashboard');
    }

    $tareaAlumnoModel = new \App\Models\TareaAlumnoModel();
    
    $data = [
        'title' => 'Mis Tareas',
        'tareas' => $tareaAlumnoModel->getTareasByAlumno(session()->get('user_id'))
    ];
    
    return view('alumno/mis_tareas', $data);
}
}