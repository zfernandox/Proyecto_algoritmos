<?php
// app/Controllers/EntregaController.php
namespace App\Controllers;

use App\Models\TareaAlumnoModel;

class EntregaController extends BaseController
{
    public function entregar($tarea_id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'alumno') {
            return redirect()->to('/dashboard');
        }

        $tareaAlumnoModel = new TareaAlumnoModel();
        
        // Verificar que la tarea está asignada al alumno
        $tareaAsignada = $tareaAlumnoModel->where('tarea_id', $tarea_id)
                                         ->where('alumno_id', session()->get('user_id'))
                                         ->first();

        if (!$tareaAsignada) {
            return redirect()->to('/alumno/mis-tareas')->with('error', 'Tarea no asignada.');
        }

        $data = [
            'title' => 'Entregar Tarea',
            'tarea' => $tareaAsignada,
            'tarea_id' => $tarea_id
        ];

        return view('alumno/entregar', $data);
    }

    public function guardarEntrega($tarea_id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'alumno') {
            return redirect()->to('/dashboard');
        }

        $tareaAlumnoModel = new TareaAlumnoModel();
        
        $datosEntrega = [
            'estado' => 'entregada',
            'comentario_entrega' => $this->request->getPost('comentario'),
            'fecha_entrega_envio' => date('Y-m-d H:i:s')
        ];

        // Actualizar la entrega
        $tareaAlumnoModel->where('tarea_id', $tarea_id)
                        ->where('alumno_id', session()->get('user_id'))
                        ->set($datosEntrega)
                        ->update();

        session()->setFlashdata('success', '✅ Tarea entregada exitosamente.');
        return redirect()->to('/alumno/mis-tareas');
    }
}