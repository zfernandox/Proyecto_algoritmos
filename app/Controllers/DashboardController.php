<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    
public function index()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    // REDIRIGIR SEGÚN ROL
    if (session()->get('role') === 'alumno') {
        return $this->dashboardAlumno();
    } else {
        return $this->dashboardProfesor();
    }
}

private function dashboardProfesor()
{
    $usuarioModel = new \App\Models\UsuarioModel();
    $tareaModel = new \App\Models\TareaModel();
    
    $data = [
        'total_tareas' => $tareaModel->where('profesor_id', session()->get('user_id'))->countAllResults(),
        'total_alumnos' => $usuarioModel->where('tipo', 'alumno')->where('estado', 'activo')->countAllResults(),
        'tareas_pendientes' => $tareaModel->where('profesor_id', session()->get('user_id'))
                                         ->where('cestado', 'pendiente')
                                         ->countAllResults()
    ];

    return view('dashboard/index', $data);
}

private function dashboardAlumno()
{
    $tareaAlumnoModel = new \App\Models\TareaAlumnoModel();
    
    $tareasAlumno = $tareaAlumnoModel->where('alumno_id', session()->get('user_id'))->findAll();
    
    $data = [
        'tareas_pendientes' => count(array_filter($tareasAlumno, function($tarea) {
            return $tarea['estado'] === 'asignada';
        })),
        'tareas_entregadas' => count(array_filter($tareasAlumno, function($tarea) {
            return $tarea['estado'] === 'entregada';
        })),
        'promedio' => '8.5', // Temporal
        'proxima_entrega' => '30/03' // Temporal
    ];

    return view('alumno/dashboard', $data);
}

}