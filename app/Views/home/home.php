<?= $this->include('layouts/header') ?>

<div class="row align-items-center">
    <div class="col-md-13">
        <h1 class="display-2 fw-bold text-primary">
            <?= lang('App.welcome') ?>
        </h1>

        <div class="row align-items-center">
            <div class="col-md-4">
                <h1 class="display-9 fw-bold text-secondary">
                    <?= lang('App.school_organizer') ?>
                </h1>
                <p class="lead mt-4">
                    <?= lang('App.system_description') ?>
                </p>
                <div class="pt-4"></div>
                <div class="lead mt-4">
                    <a href="<?= site_url('/login') ?>" class="btn btn-primary btn-lg me-12">
                        <i class="fas fa-sign-in-alt me-4"></i>
                        <?= lang('App.login') ?>
                    </a>
                </div>
            </div>
            
            <div class="col-md-8 text-center">
                <i class="fas fa-school fa-10x text-primary opacity-50"></i>
            </div>
            <div class="pt-4"></div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>