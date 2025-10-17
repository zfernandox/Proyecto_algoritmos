<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">
                <i class="fas fa-star me-2"></i>
                <?= lang('App.grade_task') ?>
            </h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title mb-0 text-white"><?= lang('App.grade_delivery') ?></h5>
                </div>
                <div class="card-body">
                    <!-- Información de la entrega -->
                    <div class="mb-4 p-3 bg-light rounded">
                        <h6><?= esc($entrega['título']) ?></h6>
                        <p class="mb-1 small"><?= esc($entrega['descripción']) ?></p>
                        <small class="text-muted">
                            <i class="fas fa-user-graduate me-1"></i><?= lang('App.student') ?>: <?= esc($entrega['alumno_nombre']) ?> | 
                            <i class="fas fa-calendar me-1"></i><?= lang('App.submitted_on') ?>: <?= date('d/m/Y H:i', strtotime($entrega['fecha_entrega_envio'])) ?>
                        </small>
                        
                        <?php if (!empty($entrega['comentario_entrega'])): ?>
                            <div class="mt-2 p-2 bg-white rounded">
                                <small><strong><?= lang('App.student_comment') ?>:</strong> <?= esc($entrega['comentario_entrega']) ?></small>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($entrega['archivo_entrega'])): ?>
                            <div class="mt-2">
                                <a href="<?= base_url('writable/uploads/entregas/' . $entrega['archivo_entrega']) ?>" 
                                   class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fas fa-download me-1"></i><?= lang('App.download_file') ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="<?= site_url('profesor/guardar-calificacion/' . $entrega['id']) ?>" method="POST">
                        <!-- Calificación -->
                        <div class="mb-3">
                            <label for="calificacion" class="form-label">
                                <strong><?= lang('App.grade') ?></strong>
                            </label>
                            <input type="number" class="form-control form-control-lg" id="calificacion" name="calificacion" 
                                   min="0" max="100" step="0.1" required
                                   style="font-size: 1.2rem;">
                            <div class="form-text"><?= lang('App.enter_grade_instructions') ?></div>
                        </div>

                        <!-- Comentario de calificación -->
                        <div class="mb-4">
                            <label for="comentario_calificacion" class="form-label">
                                <strong><?= lang('App.grade_comment') ?></strong>
                            </label>
                            <textarea class="form-control" id="comentario_calificacion" name="comentario_calificacion" rows="4" 
                                      placeholder="<?= lang('App.grade_comment_placeholder') ?>"></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="<?= site_url('profesor/calificaciones') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i><?= lang('App.back') ?>
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle me-1"></i><?= lang('App.save_grade') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>