<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="alert alert-success">
        <h4><?= lang('App.task_saved_success') ?></h4>
        <p><?= lang('App.redirecting_tasks') ?></p>
    </div>
</div>

<script>
setTimeout(function() {
    window.location.href = '<?= base_url('tareas') ?>';
}, 2000);
</script>

<?= $this->include('layouts/footer') ?>