<!DOCTYPE html>
<html lang="<?= current_lang() === 'es' ? 'es' : 'en' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('App.school_task_organizer') ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .main-container {
            min-height: 75vh;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
    </style>
</head>
<script>
function cambiarIdioma(lang) {
    // Hacer petición para cambiar idioma
    fetch(`<?= site_url('language/') ?>${lang}`)
        .then(response => {
            if (response.ok) {
                // Recargar la página después de cambiar idioma
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Fallback: recargar directamente a la URL
            window.location.href = `<?= site_url('language/') ?>${lang}`;
        });
}
</script>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
           <div class="navbar-nav me-auto">
                <a class="nav-link" href="<?= site_url('/') ?>">
                    <i class="fas fa-home me-1"></i>
                    <?= lang('App.home') ?>
                </a>          
            </div>

            <!-- banderas -->
            <div class="ms-3">
                <a href="#" onclick="cambiarIdioma('es')" class="text-decoration-none me-2" title="Español">
                    <img src="https://flagcdn.com/w20/es.png" alt="Español" style="width: 25px; height: 15px;">
                </a>
                <a href="#" onclick="cambiarIdioma('en')" class="text-decoration-none me-2" title="English">
                    <img src="https://flagcdn.com/w20/gb.png" alt="English" style="width: 25px; height: 15px;">
                </a>
            </div>
            
            <?php if(session()->get('nombre')): ?>
                <!-- Menú cuando el usuario está logueado -->
                <div class="navbar-nav user-menu">
                    <!-- Nombre de usuario -->
                    <span class="navbar-text">
                        <a class="nav-link" href="<?= base_url('/index.php/dashboard') ?>">
                            <i class="fas fa-user me-1"></i>
                            <?= lang('App.hello') ?>, <?= session()->get('nombre') ?? lang('App.user') ?>
                        </a>
                    </span>
                    
                    <!-- Dropdown Mi Cuenta -->
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?= lang('App.my_account') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="<?= site_url('/perfil') ?>">
                                    <i class="fas fa-user-edit me-2"></i>
                                    <?= lang('App.my_profile') ?>
                                </a>
                            </li>
                            <?php if(session()->get('role') === 'profesor'): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('/users') ?>">
                                        <i class="fas fa-users me-2"></i>
                                        <?= lang('App.manage_users') ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item" href="<?= session()->get('role') === 'profesor' ? site_url('/tareas') : site_url('/alumno/mis-tareas') ?>">
                                    <i class="fas fa-tasks me-2"></i>
                                    <?= session()->get('role') === 'profesor' ? lang('App.manage_tasks') : lang('App.my_tasks') ?>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="<?= site_url('/logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    <?= lang('App.logout') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <!-- Menú cuando no hay usuario logueado -->
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="<?= site_url('/login') ?>">
                        <i class="fas fa-sign-in-alt me-1"></i>
                        <?= lang('App.login') ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container main-container mt-4">