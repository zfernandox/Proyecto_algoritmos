<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-lock me-2"></i>
                    <?= lang('App.change_password') ?>
                </h4>
            </div>
            
            <div class="card-body">
                <!-- Mensajes -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('/perfil/actualizar-password') ?>" method="POST">
                    <!-- Contraseña Actual -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.current_password') ?></label>
                        <input type="password" class="form-control" name="password_actual" 
                               placeholder="<?= lang('App.enter_current_password') ?>" required>
                    </div>

                    <!-- Nueva Contraseña -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.new_password') ?></label>
                        <input type="password" class="form-control" name="nuevo_password" 
                               placeholder="<?= lang('App.create_new_password') ?>" required minlength="6">
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.confirm_new_password') ?></label>
                        <input type="password" class="form-control" name="confirmar_password" 
                               placeholder="<?= lang('App.repeat_new_password') ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('/perfil') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            <?= lang('App.cancel') ?>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key me-2"></i>
                            <?= lang('App.change_password') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>