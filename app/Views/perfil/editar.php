<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    <?= lang('App.edit_personal_info') ?>
                </h4>
            </div>
            
            
            <div class="card-body">
                <!-- Mensajes -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('/perfil/actualizar') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.full_name') ?></label>
                        <input type="text" class="form-control" name="nombre" 
                               value="<?= $usuario['nombre'] ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.email') ?></label>
                        <input type="email" class="form-control" name="email" 
                               value="<?= $usuario['email'] ?>" required>
                    </div>

                    <!-- 🎯 CAMPO DE CONTRASEÑA REQUERIDO -->
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.current_password') ?></label>
                        <input type="password" class="form-control" name="password_actual" 
                               placeholder="<?= lang('App.enter_password_confirm') ?>" required>
                        <div class="form-text"><?= lang('App.password_confirm_text') ?></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('/perfil') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            <?= lang('App.cancel') ?>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            <?= lang('App.save_changes') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>