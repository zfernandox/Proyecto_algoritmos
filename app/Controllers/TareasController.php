<?php

namespace App\Controllers;

class TareasController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'session']);
    }
    
    
   public function index(){
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaModel = new \App\Models\TareaModel();
    
    // Buscador
    $search = $this->request->getGet('search') ?? ''; 
    
    // Paginación
    $perPage = 4; // Tareas por página
    
    // Base query
    $query = $tareaModel->where('profesor_id', session()->get('user_id'))
                        ->orderBy("fecha_entrega", "DESC");
    // Aplicar búsqueda si existe
    if (!empty($search)) {
        $query->like('título', $search)->orLike('descripción', $search);
    }
    
    // Obtener tareas paginadas 
    $tareas = $query->paginate($perPage);
    $pager = $tareaModel->pager;

    $data = [
        'title' => 'Gestión de Tareas',
        'tareas' => $tareas,
        'search_term' => $search,
        'pager' => $pager 
    ];
    
    return view('tareas/index', $data);
    }
    
    // Mostrar formulario para crear nueva tarea
    
    public function crear()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Crear Nueva Tarea '
        ];
        
        return view('tareas/crear', $data);
    }
    public function editar($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaModel = new \App\Models\TareaModel();
    
    // Obtener la tarea de la BD
    $tarea = $tareaModel->find($id);
    
    // Verificar que la tarea existe y pertenece al profesor
    if (!$tarea || $tarea['profesor_id'] != session()->get('user_id')) {
        return redirect()->to('/tareas')->with('error', 'Tarea no encontrada.');
    }

    $data = [
        'title' => 'Editar Tarea',
        'tarea' => $tarea
    ];
    
    return view('tareas/editar', $data);
}
    
    
    //Procesar actualización de tarea
    public function actualizar($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaModel = new \App\Models\TareaModel();
    
    // Verificar que la tarea existe
    $tarea = $tareaModel->find($id);
    
    if (!$tarea) {
        return redirect()->to('/tareas')->with('error', 'Error: La tarea con ID ' . $id . ' no existe.');
    }
    
    // Verificar que pertenece al profesor
    if ($tarea['profesor_id'] != session()->get('user_id')) {
        return redirect()->to('/tareas')->with('error', 'No tienes permisos para editar esta tarea.');
    }

    // Datos actualizados
    $tareaData = [
        'título' => $this->request->getGet('titulo'),
        'descripción' => $this->request->getGet('descripcion'),
        'fecha_entrega' => $this->request->getGet('fecha_entrega'),
        'cestado' => $this->request->getGet('estado') ?? 'pendiente'
    ];
    
    // Actualizar en la BD
    if ($tareaModel->update($id, $tareaData)) {
        // Mensaje de éxito
        session()->setFlashdata('success', "Tarea  actualizada exitosamente.");
    } else {
        // Mensaje de error
        session()->setFlashdata('error', "Error al actualizar la tarea.");
    }
    
    return redirect()->to('/tareas');
}
    

public function nueva()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }
    
    $data = [
        'title' => 'Nueva Tarea '
    ];
    
    return view('tareas/nueva', $data);
}
public function guardar()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaModel = new \App\Models\TareaModel();
    $tareaAlumnoModel = new \App\Models\TareaAlumnoModel();
    
    
    $tareaData = [
        'título' => $this->request->getGet('titulo'),
        'descripción' => $this->request->getGet('descripcion'),
        'fecha_entrega' => $this->request->getGet('fecha_entrega'),
        'cestado' => 'pendiente',
        'profesor_id' => session()->get('user_id')
    ];
    
    // Guardar tarea
    $tareaId = $tareaModel->insert($tareaData);
    
    // Asignar tarea a alumnos seleccionados
    $alumnosSeleccionados = $this->request->getGet('alumnos') ?? [];
    
    foreach ($alumnosSeleccionados as $alumnoId) {
        $tareaAlumnoModel->insert([
            'tarea_id' => $tareaId,
            'alumno_id' => $alumnoId,
            'estado' => 'asignada'
        ]);
    }
    
    // Mensaje de éxito
    $session = session();
    $mensaje = "Tarea '{$tareaData['título']}' creada exitosamente";
    
    if (count($alumnosSeleccionados) > 0) {
        $mensaje .= " y asignada a " . count($alumnosSeleccionados) . " alumnos";
    }
    
    $session->setFlashdata('success', $mensaje);
    
    return redirect()->to('/tareas');
}
public function eliminar($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaModel = new \App\Models\TareaModel();
    $tareaAlumnoModel = new \App\Models\TareaAlumnoModel();
    
    // Verificar que la tarea existe
    $tarea = $tareaModel->find($id);
    
    if (!$tarea) {
        return redirect()->to('/tareas')->with('error', 'Error: La tarea no existe.');
    }
    
    // Verificar que pertenece al profesor
    if ($tarea['profesor_id'] != session()->get('user_id')) {
        return redirect()->to('/tareas')->with('error', 'No tienes permisos para eliminar esta tarea.');
    }

    // Primero eliminar las asignaciones a alumnos
    $tareaAlumnoModel->where('tarea_id', $id)->delete();
    
    // Luego eliminar la tarea
    if ($tareaModel->delete($id)) {
        session()->setFlashdata('success', " Tarea eliminada exitosamente.");
    } else {
        session()->setFlashdata('error', "Error al eliminar la tarea.");
    }
    
    return redirect()->to('/tareas');
}


public function calificaciones()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaAlumnoModel = new \App\Models\TareaAlumnoModel();
    
    $estadisticas = $tareaAlumnoModel->getEstadisticasCalificaciones(session()->get('user_id'));
    
    //  Redondear manualmente el promedio
    if ($estadisticas && isset($estadisticas['promedio_general'])) {
        $estadisticas['promedio_general'] = round($estadisticas['promedio_general'], 1);
    }
    
    $data = [
        'title' => 'Calificar Entregas',
        'entregas' => $tareaAlumnoModel->getEntregasPendientesCalificacion(session()->get('user_id')),
        'estadisticas' => $estadisticas
    ];
    
    return view('professor/calificar', $data);
}

public function formCalificar($entrega_id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaAlumnoModel = new \App\Models\TareaAlumnoModel();
    
    // Obtener información completa de la entrega
    $entrega = $tareaAlumnoModel->select('tareas_alumnos.*, tareas.título, tareas.descripción, usuarios.nombre as alumno_nombre')
                               ->join('tareas', 'tareas.id = tareas_alumnos.tarea_id')
                               ->join('usuarios', 'usuarios.id = tareas_alumnos.alumno_id')
                               ->where('tareas_alumnos.id', $entrega_id)
                               ->first();

    if (!$entrega) {
        return redirect()->to('/profesor/calificaciones')->with('error', 'Entrega no encontrada.');
    }

    $data = [
        'title' => 'Calificar Tarea',
        'entrega' => $entrega
    ];
    
    return view('professor/calificar_form', $data);
}

public function guardarCalificacion($entrega_id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $tareaAlumnoModel = new \App\Models\TareaAlumnoModel();
    
    // Validar datos
    $calificacion = $this->request->getPost('calificacion');
    $comentario = $this->request->getPost('comentario_calificacion');
    
    if ($calificacion < 0 || $calificacion > 100) {
        return redirect()->back()->with('error', 'La calificación debe estar entre 0 y 100.');
    }

    // Guardar calificación
    if ($tareaAlumnoModel->calificarEntrega($entrega_id, $calificacion, $comentario)) {
        session()->setFlashdata('success', '✅ Calificación guardada exitosamente.');
        return redirect()->to('/profesor/calificaciones');
    } else {
        return redirect()->back()->with('error', 'Error al guardar la calificación.');
    }
}
}