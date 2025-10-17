<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    <?= lang('App.create_account') ?>
                </h4>
            </div>
            <div class="card-body p-4">
                <!-- Mensaje de error -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Mensaje de éxito -->
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Formulario de Registro -->
                <form action="<?= site_url('/auth/procesarRegistro') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user me-1"></i>
                                    <?= lang('App.full_name') ?>
                                </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       placeholder="<?= lang('App.name_placeholder') ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>
                                    <?= lang('App.email') ?>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="<?= lang('App.email_placeholder') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-1"></i>
                                    <?= lang('App.password') ?>
                                </label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="<?= lang('App.password_minimum') ?>" required minlength="6">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">
                                    <i class="fas fa-lock me-1"></i>
                                    <?= lang('App.confirm_password') ?>
                                </label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                       placeholder="<?= lang('App.repeat_password') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">
                            <i class="fas fa-user-tag me-1"></i>
                            <?= lang('App.user_type') ?>
                        </label>
                        <select class="form-select" id="rol" name="rol" required>
                            <option value=""><?= lang('App.select_role') ?></option>
                            <option value="profesor"><?= lang('App.teacher') ?></option>
                            <option value="alumno"><?= lang('App.student') ?></option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>
                            <?= lang('App.create_account') ?>
                        </button>
                    </div>
                </form>

                <!-- Enlace para volver al Login -->
                <div class="text-center mt-4 pt-3 border-top">
                    <p class="text-muted mb-2"><?= lang('App.have_account') ?></p>
                    <a href="<?= site_url('/login') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <?= lang('App.login') ?>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>