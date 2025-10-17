<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">
                <i class="fas fa-tasks me-2"></i>
                <?= lang('App.my_tasks') ?>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php if (empty($tareas)): ?>
                <div class="alert alert-info">
                    <?= lang('App.no_tasks_assigned') ?>
                </div>
            <?php else: ?>
                <div class="list-group">
                    <?php foreach ($tareas as $tarea): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="mb-1"><?= esc($tarea['título']) ?></h6>
                                <p class="mb-1 text-muted small"><?= esc($tarea['descripción']) ?></p>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i><?= lang('App.due_date') ?>: <?= $tarea['fecha_entrega'] ?> | 
                                    <i class="fas fa-info-circle me-1"></i><?= lang('App.status') ?>: 
                                    <?php if ($tarea['estado_asignacion'] === 'asignada'): ?>
                                        <span class="badge bg-warning"><?= lang('App.pending') ?></span>
                                    <?php elseif ($tarea['estado_asignacion'] === 'entregada'): ?>
                                        <span class="badge bg-success"><?= lang('App.submitted') ?></span>
                                    <?php elseif ($tarea['estado_asignacion'] === 'calificada'): ?>
                                        <span class="badge bg-info"><?= lang('App.graded') ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= $tarea['estado_asignacion'] ?></span>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($tarea['calificacion'])): ?>
                                        | <i class="fas fa-star me-1 text-warning"></i><?= lang('App.grade') ?>: <?= round($tarea['calificacion'], 1) ?>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($tarea['fecha_entrega_envio'])): ?>
                                        | <i class="fas fa-paper-plane me-1"></i><?= lang('App.submitted_on') ?>: <?= date('d/m/Y', strtotime($tarea['fecha_entrega_envio'])) ?>
                                    <?php endif; ?>
                                </small>
                                
                                <?php if (!empty($tarea['comentario_entrega'])): ?>
                                    <div class="mt-2 p-2 bg-light rounded">
                                        <small><strong><?= lang('App.your_comment') ?>:</strong> <?= esc($tarea['comentario_entrega']) ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="ms-3">
                                <?php if ($tarea['estado_asignacion'] === 'asignada'): ?>
                                    <a href="<?= site_url('entregas/entregar/' . $tarea['id']) ?>" class="btn btn-sm btn-primary">
                                       <?= lang('App.submit') ?>
                                    </a>
                                <?php elseif ($tarea['estado_asignacion'] === 'entregada'): ?>
                                    <span class="badge bg-success"><?= lang('App.submitted') ?></span>
                                    <br>
                                    <small class="text-muted"><?= lang('App.awaiting_grade') ?></small>
                                <?php elseif ($tarea['estado_asignacion'] === 'calificada'): ?>
                                    <span class="badge bg-info"><?= lang('App.graded') ?></span>
                                    <?php if (!empty($tarea['calificacion'])): ?>
                                        <br>
                                        <small class="text-warning">
                                            <i class="fas fa-star"></i> <?= round($tarea['calificacion'], 1) ?>
                                        </small>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>