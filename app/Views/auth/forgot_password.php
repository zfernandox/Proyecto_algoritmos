<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="btn btn-primary btn-lg">
                <h4 class="text-center mb-0">
                    <i class="fas fa-key me-2"></i>
                    <?= lang('App.recover_password') ?>
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

                <p class="text-muted mb-4">
                    <?= lang('App.recover_instructions') ?>
                </p>

                <!-- Formulario de Recuperación -->
                <form action="<?= site_url('/auth/procesarForgotPassword') ?>" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i>
                            <?= lang('App.email') ?>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="<?= lang('App.email_placeholder') ?>" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>
                            <?= lang('App.send_recovery_link') ?>
                        </button>
                    </div>
                </form>

                <!-- Enlace para volver al Login -->
                <div class="text-center mt-4 pt-3 border-top">
                    <a href="<?= site_url('/login') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        <?= lang('App.cancel') ?>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>