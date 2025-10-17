<?= $this->include('layouts/header') ?>

<!-- Mostrar mensaje flash -->
<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Barra Superior -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>
                    <i class="fas fa-tasks me-2"></i>
                    <?= lang('App.tasks') ?>
                </h3>
                <div>
                    <!-- Search -->
                    <form action="<?= base_url('/index.php/tareas') ?>" method="GET" class="d-flex">
                        <div class="input-group input-group-sm me-2" style="width: 200px;">
                            <input type="text" class="form-control" name="search" placeholder="<?= lang('App.search_tasks') ?>"
                                   value="<?= isset($search_term) ? esc($search_term) : '' ?>">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Botones Simple -->
            <div class="d-flex justify-content-between mb-3">
                <!-- Botón Older - Siempre visible pero deshabilitado si no hay página anterior -->
                <?php 
                $currentPage = $pager->getCurrentPage() ?? 1;
                $hasPrevious = $currentPage > 1;
                $hasNext = $currentPage < ($pager->getPageCount() ?? 1);
                ?>
                
                <?php if ($hasPrevious): ?>
                    <a href="?page=<?= $currentPage - 1 ?><?= isset($search_term) ? '&search=' . urlencode($search_term) : '' ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>
                        <?= lang('App.newer') ?>
                    </a>
                <?php else: ?>
                    <button class="btn btn-outline-secondary btn-sm" disabled>
                        <i class="fas fa-arrow-left me-1"></i>
                        <?= lang('App.newer') ?>
                    </button>
                <?php endif; ?>
                
                <!-- Botón Nueva Tarea -->
                <a href="<?= base_url('/index.php/tareas/nueva') ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-plus me-1"></i>
                    <?= lang('App.new_task') ?>
                </a>
                
                <!-- Botón Newer -->
                <?php if ($hasNext): ?>
                    <a href="?page=<?= $currentPage + 1 ?><?= isset($search_term) ? '&search=' . urlencode($search_term) : '' ?>" class="btn btn-outline-primary btn-sm">
                        <?= lang('App.older') ?>
                        <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                <?php else: ?>
                    <button class="btn btn-outline-secondary btn-sm" disabled>
                        <?= lang('App.older') ?>
                        <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                <?php endif; ?>
            </div>

            <!-- Lista Dinámica de Tareas -->
            <div class="list-group">
                <?php if (empty($tareas)): ?>
                    <div class="alert alert-info">
                        <?= isset($search_term) ? lang('App.no_tasks_found') . ' "' . esc($search_term) . '"' : lang('App.no_tasks_created') ?>
                    </div>
                <?php else: ?>
                    <?php foreach ($tareas as $tarea): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1"><?= esc($tarea['título']) ?></h6>
                                <p class="mb-1 text-muted small"><?= esc($tarea['descripción']) ?></p>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i><?= $tarea['fecha_entrega'] ?> | 
                                    <i class="fas fa-user me-1"></i><?= lang('App.status') ?>: <?= $tarea['cestado'] ?>
                                </small>
                            </div>
                            <div class="btn-group">
                                <a href="<?= base_url('index.php/tareas/editar/' . $tarea['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> <?= lang('App.edit') ?>
                                </a>
                                
                                <a href="<?= base_url('index.php/tareas/eliminar/' . $tarea['id']) ?>" class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('<?= lang('App.confirm_delete_task') ?>')">
                                    <i class="fas fa-trash"></i> <?= lang('App.delete') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>