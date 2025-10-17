<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    <?= lang('App.add_new_user') ?>
                </h4>
            </div>
            
            <div class="card-body">
                <!-- Mensajes -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('/users/guardar') ?>" method="POST">
                    <!-- Información Básica -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.full_name') ?></label>
                        <input type="text" class="form-control" name="nombre" 
                               placeholder="<?= lang('App.name_placeholder') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.email') ?></label>
                        <input type="email" class="form-control" name="email" 
                               placeholder="<?= lang('App.email_placeholder') ?>" required>
                    </div>

                    <!-- Tipo de Usuario -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.user_type') ?></label>
                        <select class="form-select" name="rol" required>
                            <option value=""><?= lang('App.select') ?>...</option>
                            <option value="profesor"><?= lang('App.teacher') ?></option>
                            <option value="alumno"><?= lang('App.student') ?></option>
                        </select>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.password') ?></label>
                        <input type="password" class="form-control" name="password" 
                               placeholder="<?= lang('App.password_minimum') ?>" required minlength="6">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.confirm_password') ?></label>
                        <input type="password" class="form-control" name="confirmar_password" 
                               placeholder="<?= lang('App.repeat_password') ?>" required>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= site_url('/users') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            <?= lang('App.cancel') ?>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            <?= lang('App.create_user') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>