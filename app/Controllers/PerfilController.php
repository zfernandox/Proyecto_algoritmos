<?php

namespace App\Controllers;

class PerfilController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'session']);
    }
    
    /**
     * Vista principal del perfil
     */
    public function index()
    {
        // Verificar que el usuario esté logueado
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Mi Perfil - Sistema Escolar',
            'usuario' => [
                'nombre' => session()->get('nombre') ?? 'Usuario',
                'email' => session()->get('email') ?? 'email@ejemplo.com'
            ]
        ];
        
        return view('perfil/index', $data);
    }
    
    /**
     * Formulario para editar información (nombre, email)
     */
    public function editar()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Editar Información - Sistema Escolar',
            'usuario' => [
                'nombre' => session()->get('nombre') ?? 'Usuario',
                'email' => session()->get('email') ?? 'email@ejemplo.com'
            ]
        ];
        
        return view('perfil/editar', $data);
    }
    
    /**
     * Formulario para cambiar foto de perfil
     */
    public function cambiarFoto()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Cambiar Foto - Sistema Escolar',
            'usuario' => [
                'nombre' => session()->get('nombre') ?? 'Usuario'
            ]
        ];
        
        return view('perfil/cambiar_foto', $data);
    }
    
    /**
     * Formulario para cambiar contraseña
     */
    public function cambiarPassword()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Cambiar Contraseña - Sistema Escolar',
            'usuario' => [
                'nombre' => session()->get('nombre') ?? 'Usuario'
            ]
        ];
        
        return view('perfil/cambiar_password', $data);
    }
    
    /**
     * Procesar actualización de información (nombre, email)
     * REQUIERE CONTRASEÑA
     */
    public function actualizar()
    {
        // Por ahora solo simulamos la actualización
        // Más adelante conectaremos con la base de datos
        
        return redirect()->to('/perfil')->with('success', 'Información actualizada correctamente');
    }
    
    public function actualizarFoto()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $validation = \Config\Services::validation();
    $validation->setRules([
        'foto' => [
            'label' => 'Imagen',
            'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Debes seleccionar una imagen',
                'max_size' => 'La imagen no debe pesar más de 2MB',
                'is_image' => 'El archivo debe ser una imagen válida',
                'mime_in' => 'Solo se permiten formatos JPG, JPEG y PNG'
            ]
        ]
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->with('error', $validation->listErrors());
    }

    $foto = $this->request->getFile('foto');
    
    if ($foto->isValid() && !$foto->hasMoved()) {
        $usuarioModel = new \App\Models\UsuarioModel();
        
        // Generar nombre único
        $nuevoNombre = $foto->getRandomName();
        
        // Mover a carpeta de uploads
        $foto->move(ROOTPATH . 'public/uploads/perfiles', $nuevoNombre);
        
        // Actualizar en base de datos
        $usuarioModel->update(session()->get('user_id'), [
            'foto_perfil' => $nuevoNombre
        ]);

        // Actualizar sesión
        session()->set('foto_perfil', $nuevoNombre);
        
        return redirect()->to('/perfil')->with('success', 'Foto de perfil actualizada correctamente');
    }

    return redirect()->back()->with('error', 'Error al subir la imagen');
}

public function eliminarFoto()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $usuarioModel = new \App\Models\UsuarioModel();
    $usuario = $usuarioModel->find(session()->get('user_id'));
    
    if ($usuario['foto_perfil']) {
        // Eliminar archivo físico
        $rutaFoto = ROOTPATH . 'public/uploads/perfiles/' . $usuario['foto_perfil'];
        if (file_exists($rutaFoto)) {
            unlink($rutaFoto);
        }
        
        // Actualizar base de datos
        $usuarioModel->update(session()->get('user_id'), [
            'foto_perfil' => null
        ]);
        
        // Actualizar sesión
        session()->set('foto_perfil', null);
        
        return redirect()->to('/perfil')->with('success', 'Foto de perfil eliminada correctamente');
    }
    
    return redirect()->to('/perfil')->with('error', 'No tienes foto de perfil');
}
    
    /**
     * Procesar cambio de contraseña
     * REQUIERE CONTRASEÑA ACTUAL
     */
    public function actualizarPassword()
    {
        // Por ahora solo simulamos la actualización
        // Más adelante implementaremos validación segura
        
        return redirect()->to('/perfil')->with('success', 'Contraseña actualizada correctamente');
    }
}