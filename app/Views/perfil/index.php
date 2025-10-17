<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    <?= lang('App.my_profile') ?>
                </h4>
            </div>
            
            <div class="card-body">
                <!-- Mensajes -->
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <!-- Información del Usuario -->
                    <div class="col-md-6">
                        <div class="text-center mb-4">
                            <img src="https://via.placeholder.com/450"  
                                 class="rounded-circle border" 
                                 style="width: 150px; height: 150px;">
                        </div>
                        
                        <!--  BOTÓN ELIMINAR FOTO -->
                        <div class="mt-2">
                            <div class="text-center mb-3">
                            <form action="<?= site_url('/perfil/eliminar-foto') ?>" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('<?= lang('App.confirm_delete_photo') ?>')">
                                    <i class="fas fa-trash me-1"></i>
                                    <?= lang('App.delete_photo') ?>
                                </button>
                            </form>
                        </div>
                    </div>

                        <div class="mb-3">
                            <h5><?= lang('App.personal_info') ?></h5>
                            <p><strong><?= lang('App.name') ?>:</strong><br><?= $usuario['nombre'] ?></p>
                            <p><strong><?= lang('App.email') ?>:</strong><br><?= $usuario['email'] ?></p>
                            <p><strong><?= lang('App.role') ?>:</strong><br>
                                <?= session()->get('rol') == 'profesor' ? lang('App.teacher') : lang('App.student') ?>
                            </p>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-md-6">
                        <h5 class="mb-4"><?= lang('App.manage_profile') ?></h5>
                        
                        <!-- Botón Editar Información -->
                        <div class="d-grid mb-3">
                            <a href="<?= site_url('/perfil/editar') ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-edit me-2"></i>
                                <?= lang('App.edit_info') ?>
                            </a>
                            <small class="text-muted mt-1"><?= lang('App.edit_info_desc') ?></small>
                        </div>

                        <!-- Botón Cambiar Imagen -->
                        <div class="d-grid mb-3">
                            <a href="<?= site_url('/perfil/cambiar-foto') ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-camera me-2"></i>
                                <?= lang('App.change_image') ?>
                            </a>
                            <small class="text-muted mt-1"><?= lang('App.change_image_desc') ?></small>
                        </div>

                        <!-- Botón Cambiar Contraseña -->
                        <div class="d-grid mb-3">
                            <a href="<?= site_url('/perfil/cambiar-password') ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-lock me-2"></i>
                                <?= lang('App.change_password') ?>
                            </a>
                            <small class="text-muted mt-1"><?= lang('App.change_password_desc') ?></small>
                        </div>
                    </div>
                </div>

                <!-- Botón Volver -->
                <div class="text-center mt-4">
                    <a href="/code4/public/index.php/dashboard#" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        <?= lang('App.back') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>