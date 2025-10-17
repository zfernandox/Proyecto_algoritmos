<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">
                <i class="fas fa-paper-plane me-2"></i>
                <?= lang('App.submit_task') ?>
            </h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?= lang('App.complete_delivery') ?></h5>
                </div>
                <div class="card-body">
                    <!-- CAMBIO IMPORTANTE: method="POST" y enctype="multipart/form-data" -->
                    <form action="<?= site_url('entregas/guardar/' . $tarea_id) ?>" method="POST" enctype="multipart/form-data">
                        
                        <!-- Comentario de entrega -->
                        <div class="mb-3">
                            <label for="comentario" class="form-label"><?= lang('App.delivery_comment') ?></label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="4" 
                                      placeholder="<?= lang('App.delivery_placeholder') ?>"></textarea>
                        </div>

                        <!-- SUBIDA DE ARCHIVOS - NUEVA SECCIÓN -->
                        <div class="mb-3">
                            <label for="archivo" class="form-label"><?= lang('App.upload_file') ?></label>
                            <input type="file" class="form-control" id="archivo" name="archivo" 
                                   accept=".pdf,.doc,.docx,.txt,.zip,.rar,.jpg,.jpeg,.png,.gif">
                            <div class="form-text">
                                <?= lang('App.allowed_formats') ?>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="<?= site_url('alumno/mis-tareas') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i><?= lang('App.cancel') ?>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i><?= lang('App.submit_task') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>