<?= $this->include('layouts/header') ?>

<div class="container-fluid">
    <!-- Bienvenida Alumno -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-banner bg-primary text-white p-4 rounded">
                <h1 class="h3 mb-1">
                    <?= lang('App.welcome') ?>, <?= session()->get('nombre'); ?>
                </h1>
                <p class="mb-0 opacity-75"><?= lang('App.student_panel') ?></p>
            </div>
        </div>
    </div>

    <!-- ESTADÍSTICAS ALUMNO -->
    <div class="row mb-8">
        <!-- Tarjeta Tareas Pendientes -->
        <div class="col-xl-6 col-md-3 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-warning"><?= lang('App.pending_tasks') ?></h5>
                            <h2 class="display-6 fw-bold"><?= $tareas_pendientes ?? '0' ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                    <p class="card-text text-muted small"><?= lang('App.to_submit') ?></p>
                </div>
            </div>
        </div>

        <!-- Tarjeta Tareas Entregadas -->
        <div class="col-xl-6 col-md-6 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title text-success"><?= lang('App.submitted_tasks') ?></h5>
                            <h2 class="display-6 fw-bold"><?= $tareas_entregadas ?? '0' ?></h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                    <p class="card-text text-muted small"><?= lang('App.completed') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ACCIONES RÁPIDAS ALUMNO -->
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
                        <div class="col-lg-4 col-md-6">
                            <a href="<?= base_url('/index.php/alumno/mis-tareas') ?>" class="btn btn-primary w-100 h-100 py-3">
                                <i class="fas fa-tasks fa-2x mb-2"></i><br>
                                <?= lang('App.my_tasks') ?>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <a href="<?= base_url('/index.php/perfil') ?>" class="btn btn-success w-100 h-100 py-3">
                                <i class="fas fa-user fa-2x mb-2"></i><br>
                                <?= lang('App.my_profile') ?>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <a href="<?= base_url('/index.php/alumno/calificaciones') ?>" class="btn btn-info w-100 h-100 py-3">
                                <i class="fas fa-star fa-2x mb-2"></i><br>
                                <?= lang('App.my_grades') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>