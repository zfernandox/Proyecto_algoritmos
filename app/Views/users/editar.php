<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        <?= lang('App.edit_user') ?>
                    </h4>
                    <div>
                        <!-- 🆕 BOTÓN ELIMINAR -->
                        <a href="<?= site_url('/users/eliminar/' . $usuario_id) ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('<?= lang('App.confirm_delete_user') ?>')">
                            <i class="fas fa-trash me-1"></i>
                            <?= lang('App.delete') ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Información de Fechas -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body py-2">
                                <small class="text-muted">
                                    <strong><?= lang('App.creation_date') ?>:</strong> 15/03/2024 10:30 AM
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body py-2">
                                <small class="text-muted">
                                    <strong><?= lang('App.last_update') ?>:</strong> 20/03/2024 02:15 PM
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mensajes -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('/users/actualizar/' . $usuario_id) ?>" method="POST">
                    <!-- Información Básica -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.full_name') ?></label>
                        <input type="text" class="form-control" name="nombre" 
                               value="Margarita Profesora" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.email') ?></label>
                        <input type="email" class="form-control" name="email" 
                               value="margarita@escuela.com" required>
                    </div>

                    <!-- Tipo de Usuario -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.user_type') ?></label>
                        <select class="form-select" name="rol" required>
                            <option value="profesor" selected><?= lang('App.teacher') ?></option>
                            <option value="alumno"><?= lang('App.student') ?></option>
                        </select>
                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.status') ?></label>
                        <select class="form-select" name="estado">
                            <option value="activo" selected><?= lang('App.active') ?></option>
                            <option value="inactivo"><?= lang('App.inactive') ?></option>
                        </select>
                    </div>

                    <!-- 🆕 BOTONES ABAJO -->
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <a href="<?= site_url('/users') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            <?= lang('App.back_to_list') ?>
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                <?= lang('App.save_changes') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>