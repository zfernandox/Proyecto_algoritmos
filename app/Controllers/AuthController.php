<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'session']);
    }
    
    /**
     * Muestra la página de login
     */
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        
        return view('auth/login');
    }
    
    /**
     * Muestra el formulario de registro
     */
    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        
        return view('auth/register');
    }
    
    /**
     * Procesa el formulario de login
     */
    public function procesarLogin()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $usuarioModel = new \App\Models\UsuarioModel();
    $usuario = $usuarioModel->getUsuarioByEmail($email);

    if ($usuario) {
        // Verificar contraseña (asumiendo que no está hasheada)
        if ($password === $usuario['contraseña']) {
            
            // Crear sesión
            $session = session();
            $session->set([
                'user_id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'email' => $usuario['email'],
                'role' => $usuario['tipo'],  // 'profesor' o 'alumno'
                'estado' => $usuario['estado'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        }
    }

    // Si falla el login
    return redirect()->back()->with('error', 'Email o contraseña incorrectos');
}
    
    /**
     * Procesa el formulario de registro  
     */
    public function procesarRegistro()
    {
        // Por ahora solo redirige al login
        return redirect()->to('/login')->with('success', '¡Cuenta creada exitosamente! Ya puedes iniciar sesión.');
    }
    
    /**
     * Muestra el formulario de olvidé contraseña
     */
    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    /**
     * Procesa el formulario de olvidé contraseña
     */
    public function procesarForgotPassword()
    {
        // Por ahora solo muestra mensaje
        // Más adelante implementaremos el envío de email
        
        return redirect()->to('/login')->with('success', 'Se ha enviado un enlace de recuperación a tu correo electrónico.');
    }
    
    /**
     * Cierra la sesión
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Sesión cerrada correctamente');
    }
    
}