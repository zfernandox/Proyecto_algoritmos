<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">
                <i class="fas fa-edit me-2"></i>
                <?= lang('App.edit_task') ?>
            </h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?= lang('App.edit_task_info') ?></h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/index.php/tareas/actualizar/' . $tarea['id']) ?>" method="GET">
                        <div class="mb-3">
                            <label for="titulo" class="form-label"><?= lang('App.task_title') ?></label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required 
                                   value="<?= esc($tarea['título']) ?>">
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label"><?= lang('App.description') ?></label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= esc($tarea['descripción']) ?></textarea>
                        </div>

                        <!-- Fecha de Entrega -->
                        <div class="mb-3">
                            <label for="fecha_entrega" class="form-label"><?= lang('App.due_date') ?></label>
                            <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required 
                                   value="<?= $tarea['fecha_entrega'] ?>">
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="estado" class="form-label"><?= lang('App.status') ?></label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="pendiente" <?= $tarea['cestado'] == 'pendiente' ? 'selected' : '' ?>><?= lang('App.pending') ?></option>
                                <option value="completada" <?= $tarea['cestado'] == 'completada' ? 'selected' : '' ?>><?= lang('App.completed') ?></option>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/code4/public/index.php/tareas" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i><?= lang('App.cancel') ?>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i><?= lang('App.update_task') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>