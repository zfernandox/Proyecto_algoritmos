<?= $this->include('layouts/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-camera me-2"></i>
                    <?= lang('App.change_profile_image') ?>
                </h4>
            </div>
            
            <div class="card-body">
                <!-- Vista previa de la imagen actual -->
                <div class="text-center mb-4">
                    <img src="https://via.placeholder.com/450"  
                         class="rounded-circle border" 
                         style="width: 200px; height: 200px;">
                    <p class="text-muted mt-2"><?= lang('App.current_image') ?></p>
                </div>
                

                <form action="<?= site_url('/perfil/actualizar-foto') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label"><?= lang('App.select_new_image') ?></label>
                        <input type="file" class="form-control" name="foto" accept="image/*" required>
                        <div class="form-text">
                            <?= lang('App.image_formats') ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('/perfil') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            <?= lang('App.back') ?>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i>
                            <?= lang('App.change_image') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>