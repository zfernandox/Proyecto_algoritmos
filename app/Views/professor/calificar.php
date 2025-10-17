<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">
                <i class="fas fa-star me-2"></i>
                <?= lang('App.grade_tasks') ?>
            </h1>
            <p class="text-muted"><?= lang('App.review_grade_tasks') ?></p>
        </div>
    </div>

    <!-- Mensajes de éxito/error -->
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Estadísticas -->
    <?php if(isset($estadisticas)): ?>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $estadisticas['total_entregas'] ?? 0 ?></h5>
                    <p class="card-text mb-0"><?= lang('App.total_deliveries') ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $estadisticas['total_calificadas'] ?? 0 ?></h5>
                    <p class="card-text mb-0"><?= lang('App.graded') ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= ($estadisticas['total_entregas'] ?? 0) - ($estadisticas['total_calificadas'] ?? 0) ?></h5>
                    <p class="card-text mb-0"><?= lang('App.pending') ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Lista de entregas pendientes -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>
                        <?= lang('App.pending_grade_deliveries') ?>
                    </h5>
                </div>
                <div class="card-body">
                    <?php if(empty($entregas)): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check me-2"></i>
                            <?= lang('App.no_pending_deliveries') ?>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?= lang('App.student') ?></th>
                                        <th><?= lang('App.task') ?></th>
                                        <th><?= lang('App.description') ?></th>
                                        <th><?= lang('App.delivery_date') ?></th>
                                        <th><?= lang('App.file') ?></th>
                                        <th><?= lang('App.actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($entregas as $entrega): ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($entrega['alumno_nombre']) ?></strong>
                                            <br>
                                            <small class="text-muted"><?= esc($entrega['alumno_email']) ?></small>
                                        </td>
                                        <td>
                                            <strong><?= esc($entrega['título']) ?></strong>
                                        </td>
                                        <td>
                                            <?= substr($entrega['descripción'] ?? '', 0, 50) . '...' ?>
                                        </td>
                                        <td>
                                            <small>
                                                <?= date('d/m/Y H:i', strtotime($entrega['fecha_entrega_envio'])) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <?php if (!empty($entrega['archivo_entrega'])): ?>
                                                <a href="<?= base_url('writable/uploads/entregas/' . $entrega['archivo_entrega']) ?>" 
                                                   class="btn btn-sm btn-outline-primary" target="_blank" 
                                                   title="<?= lang('App.download_file') ?>">
                                                    <i class="fas fa-download me-1"></i><?= lang('App.file') ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="badge bg-secondary"><?= lang('App.no_file') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('profesor/calificar/' . $entrega['id']) ?>" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-star me-1"></i><?= lang('App.grade') ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>