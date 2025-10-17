<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center mb-0">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    <?= lang('App.login') ?>
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

                <!-- Formulario de Login -->
                <form action="<?= site_url('/auth/procesarLogin') ?>" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i>
                            <?= lang('App.email') ?>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="<?= lang('App.email_placeholder') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-1"></i>
                            <?= lang('App.password') ?>
                        </label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="<?= lang('App.password_placeholder') ?>" required>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            <i class="fas fa-remember me-1"></i>
                            <?= lang('App.remember_me') ?>
                        </label>
                    </div>

                    <div>
                        <a href="<?= site_url('/forgot-password') ?>" class="text-decoration-none">
                            <i class="fas fa-key me-1"></i>
                            <?= lang('App.forgot_password') ?>
                        </a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <?= lang('App.login_to_system') ?>
                        </button>
                    </div>
                </form>

                <!-- Enlace de Registro -->
                <div class="text-center mt-4 pt-3 border-top">
                    <p class="text-muted mb-2"><?= lang('App.no_account') ?></p>
                    <a href="<?= site_url('/register') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-user-plus me-2"></i>
                        <?= lang('App.create_account') ?>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>