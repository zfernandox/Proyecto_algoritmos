<?php

use CodeIgniter\Router\RouteCollection;

/** 
 * @var RouteCollection $routes
 */

// Página principal - HOME
$routes->get('/', 'Home::index');

// Autenticación
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/procesarLogin', 'AuthController::procesarLogin');
$routes->get('/logout', 'AuthController::logout');

// Dashboard (área principal después del login)
$routes->get('/dashboard', 'DashboardController::index');

// Gestión de tareas (las crearemos después)
$routes->get('/tareas', 'TareasController::index');

// Ruta original de Home (por si acaso)
$routes->get('/home', 'Home::index');
// REGISTRO
$routes->get('/register', 'AuthController::register');
$routes->post('/auth/procesarRegistro', 'AuthController::procesarRegistro');
// Olvidé contraseña
$routes->get('/forgot-password', 'AuthController::forgotPassword');
$routes->post('/auth/procesarForgotPassword', 'AuthController::procesarForgotPassword');
// perfil
$routes->get('/perfil', 'PerfilController::index');
$routes->post('/perfil/actualizar', 'PerfilController::actualizar');
// PERFIL   
$routes->get('/perfil', 'PerfilController::index');
$routes->get('/perfil/editar', 'PerfilController::editar');
$routes->get('/perfil/cambiar-foto', 'PerfilController::cambiarFoto');
$routes->get('/perfil/cambiar-password', 'PerfilController::cambiarPassword');

// Procesar formularios
$routes->post('/perfil/actualizar', 'PerfilController::actualizar');
$routes->post('/perfil/actualizar-foto', 'PerfilController::actualizarFoto');
$routes->post('/perfil/actualizar-password', 'PerfilController::actualizarPassword');
// USERS - GESTIÓN DE USUARIOS
$routes->get('/users', 'UsersController::index');
$routes->get('/users/crear', 'UsersController::crear');
$routes->post('/users/guardar', 'UsersController::guardar');
$routes->get('/users/editar/(:num)', 'UsersController::editar/$1');
$routes->post('/users/actualizar/(:num)', 'UsersController::actualizar/$1');
$routes->get('/users/eliminar/(:num)', 'UsersController::eliminar/$1');
$routes->get('/users/cambiar-estado/(:num)', 'UsersController::cambiarEstado/$1');
// TAREAS
$routes->get('/tareas', 'TareasController::index');
$routes->get('/tareas/nueva', 'TareasController::nueva');
$routes->get('/tareas/guardar', 'TareasController::guardar');
$routes->get('/tareas/editar/(:num)', 'TareasController::editar/$1');
$routes->get('/tareas/actualizar/(:num)', 'TareasController::actualizar/$1');
$routes->get('/tareas/eliminar/(:num)', 'TareasController::eliminar/$1');
$routes->get('/tareas/info/(:num)', 'TareasController::info/$1');
// base de datos 
$routes->get('testdb', 'TestDB::index');
// alumnos 
$routes->get('alumno/mis-tareas', 'AlumnoController::misTareas');
// ENTREGAS
$routes->get('entregas/entregar/(:num)', 'EntregaController::entregar/$1');
$routes->post('entregas/guardar/(:num)', 'EntregaController::guardarEntrega/$1');
/// calificaciones
$routes->get('profesor/calificaciones', 'TareasController::calificaciones');
$routes->get('profesor/calificar/(:num)', 'TareasController::formCalificar/$1');
$routes->post('profesor/guardar-calificacion/(:num)', 'TareasController::guardarCalificacion/$1');
// calificaciones de alumnos
$routes->get('alumno/calificaciones', 'AlumnoController::calificaciones');
//idiomas
$routes->get('language/(:segment)', 'LanguageController::switch/$1');