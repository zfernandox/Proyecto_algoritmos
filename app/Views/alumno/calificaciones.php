<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">
                <i class="fas fa-star me-2"></i>
                <?= lang('App.my_grades') ?>
            </h1>
            <p class="text-muted"><?= lang('App.grades_history') ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php if (empty($tareas_calificadas)): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <?= lang('App.no_grades_yet') ?>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>
                            <?= lang('App.graded_tasks') ?>: <?= count($tareas_calificadas) ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?= lang('App.task') ?></th>
                                        <th><?= lang('App.description') ?></th>
                                        <th><?= lang('App.grade') ?></th>
                                        <th><?= lang('App.teacher_comment') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($tareas_calificadas as $tarea): ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($tarea['título']) ?></strong>
                                        </td>
                                        <td>
                                            <?= esc($tarea['descripción']) ?>
                                        </td>
                                        
                                        <td>
                                            <span class="badge bg-success fs-6">
                                               <?= round($tarea['calificacion'], 1) ?>/100
                                            </span>
                                        </td>
                                        <td>
                                            <?php if (!empty($tarea['comentario_calificacion'])): ?>
                                                <span class="text-info">
                                                    <i class="fas fa-comment me-1"></i>
                                                    <?= esc($tarea['comentario_calificacion']) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted"><?= lang('App.no_comment') ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>