<?php

namespace App\Controllers;

class UsersController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'session']);
    }
    
    /**
     * Lista todos los usuarios
     */
    public function index()
    {
        // Verificar que el usuario esté logueado
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Gestión de Usuarios - Sistema Escolar',
            'page' => 'users'
        ];
        
        return view('users/index', $data);
    }
    
    /**
     * Mostrar formulario para crear nuevo usuario
     */
    public function crear()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Crear Nuevo Usuario - Sistema Escolar'
        ];
        
        return view('users/crear', $data);
    }
    
    /**
     * Procesar creación de nuevo usuario
     */
    public function guardar()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Por ahora solo simulamos la creación
        // Más adelante guardaremos en la base de datos
        
        return redirect()->to('/users')->with('success', 'Usuario creado exitosamente');
    }
    
    /**
     * Mostrar formulario para editar usuario
     */
    public function editar($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Editar Usuario - Sistema Escolar',
            'usuario_id' => $id
        ];
        
        return view('users/editar', $data);
    }
    
    /**
     * Procesar actualización de usuario
     */
    public function actualizar($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Por ahora solo simulamos la actualización
        
        return redirect()->to('/users')->with('success', 'Usuario actualizado exitosamente');
    }
    
    /**
     * Eliminar usuario
     */
    public function eliminar($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Por ahora solo simulamos la eliminación
        
        return redirect()->to('/users')->with('success', 'Usuario eliminado exitosamente');
    }
    
    /**
     * Cambiar estado de usuario (Activo/Inactivo)
     */
    public function cambiarEstado($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Por ahora solo simulamos el cambio de estado
        
        return redirect()->to('/users')->with('success', 'Estado del usuario actualizado');
    }
}