<?= $this->include('layouts/header') ?>

<!-- CONTENIDO PRINCIPAL -->
<div class="container-fluid">
    <!-- Bienvenida -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-banner bg-primary text-white p-4 rounded">
                <h1 class="h3 mb-1">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    <?php if (session()->get('role') === 'profesor'): ?>
                        <?= lang('App.welcome_teacher') ?>, <?= session()->get('nombre'); ?>
                    <?php else: ?>
                        <?= lang('App.welcome') ?>, <?= session()->get('nombre'); ?>
                    <?php endif; ?>
                </h1>
                <p class="mb-0 opacity-75"><?= lang('App.school_management') ?></p>
            </div>
        </div>
    </div>

    <!-- ESTADÍSTICAS RÁPIDAS -->
    <div class="row mb-4">
        <!-- Tarjeta Tareas Activas -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-primary"><?= lang('App.active_tasks') ?></h5>
                            <h2 class="display-6 fw-bold"><?= $total_tareas ?? '8' ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tasks fa-2x text-primary"></i>
                        </div>
                    </div>
                    <p class="card-text text-muted small"><?= lang('App.pending_tasks') ?></p>
                </div>
            </div>
        </div>

        <!-- Tarjeta Alumnos -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-success"><?= lang('App.students') ?></h5>
                            <h2 class="display-6 fw-bold"><?= $total_alumnos ?? '24' ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-graduate fa-2x text-success"></i>
                        </div>
                    </div>
                    <p class="card-text text-muted small"><?= lang('App.registered') ?></p>
                </div>
            </div>
        </div>

        <!-- Tarjeta Por Revisar -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-warning"><?= lang('App.to_review') ?></h5>
                            <h2 class="display-6 fw-bold"><?= $tareas_pendientes ?? '5' ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clipboard-check fa-2x text-warning"></i>
                        </div>
                    </div>
                    <p class="card-text text-muted small"><?= lang('App.pending_tasks') ?></p>
                </div>
            </div>
        </div>

        <!-- Tarjeta Por Calificar -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-danger"><?= lang('App.to_grade') ?></h5>
                            <h2 class="display-6 fw-bold"><?= $entregas_pendientes ?? '3' ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-star fa-2x text-danger"></i>
                        </div>
                    </div>
                    <p class="card-text text-muted small"><?= lang('App.submitted_tasks') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ACCIONES RÁPIDAS -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i><?= lang('App.quick_actions') ?>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php if (session()->get('role') === 'profesor'): ?>
                            <!-- ACCIONES PROFESOR -->
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('/index.php/tareas/nueva') ?>" class="btn btn-primary w-100 h-100 py-3">
                                    <i class="fas fa-plus-circle fa-2x mb-2"></i><br>
                                    <?= lang('App.new_task') ?>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('/index.php/users') ?>" class="btn btn-success w-100 h-100 py-3">
                                    <i class="fas fa-users fa-2x mb-2"></i><br>
                                    <?= lang('App.manage_students') ?>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('index.php/tareas') ?>" class="btn btn-info w-100 h-100 py-3">
                                    <i class="fas fa-list fa-2x mb-2"></i><br>
                                    <?= lang('App.view_tasks') ?>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= site_url('profesor/calificaciones') ?>" class="btn btn-warning w-100 h-100 py-3">
                                    <i class="fas fa-star fa-2x mb-2"></i><br>
                                    <?= lang('App.grade_tasks') ?>
                                </a>
                            </div>
                        <?php else: ?>
                            <!-- ACCIONES ALUMNO -->
                            <div class="col-lg-4 col-md-6">
                                <a href="<?= base_url('alumno/mis-tareas') ?>" class="btn btn-primary w-100 h-100 py-3">
                                    <i class="fas fa-tasks fa-2x mb-2"></i><br>
                                    <?= lang('App.my_tasks') ?>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="<?= base_url('perfil') ?>" class="btn btn-success w-100 h-100 py-3">
                                    <i class="fas fa-user fa-2x mb-2"></i><br>
                                    <?= lang('App.my_profile') ?>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a href="<?= base_url('alumno/calificaciones') ?>" class="btn btn-info w-100 h-100 py-3">
                                    <i class="fas fa-star fa-2x mb-2"></i><br>
                                    <?= lang('App.my_grades') ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>