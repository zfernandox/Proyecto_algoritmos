<?= $this->include('layouts/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">
                <i class="fas fa-plus-circle me-2"></i>
                <?= lang('App.create_new_task') ?>
            </h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?= lang('App.task_information') ?></h5>
                </div>
                <div class="card-body">
                    <form action="/code4/public/index.php/tareas/guardar" method="GET">
                        <!-- Título -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label"><?= lang('App.title') ?></label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label"><?= lang('App.description') ?></label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fecha_entrega" class="form-label"><?= lang('App.due_date') ?></label>
                            <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
                        </div>

                        <!-- Puntos -->
                        <div class="mb-3">
                            <label for="puntos" class="form-label"><?= lang('App.max_points') ?></label>
                            <input type="number" class="form-control" id="puntos" name="puntos" value="100" min="1">
                        </div>

                        <!-- ASIGNAR A ALUMNOS -->
                        <div class="mb-3">
                            <label class="form-label"><?= lang('App.assign_to_students') ?></label>
                            <div class="border p-3 rounded bg-light">
                                <small class="text-muted d-block mb-2"><?= lang('App.select_students_for_task') ?></small>
                                
                                <?php
                                $usuarioModel = new \App\Models\UsuarioModel();
                                $alumnos = $usuarioModel->where('tipo', 'alumno')->where('estado', 'activo')->findAll();
                                ?>
                                
                                <?php if (empty($alumnos)): ?>
                                    <div class="alert alert-warning">
                                        <?= lang('App.no_students_registered') ?>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($alumnos as $alumno): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="alumnos[]" 
                                               value="<?= $alumno['id'] ?>" id="alumno<?= $alumno['id'] ?>">
                                        <label class="form-check-label" for="alumno<?= $alumno['id'] ?>">
                                            <i class="fas fa-user-graduate me-1"></i>
                                            <?= esc($alumno['nombre']) ?>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/code4/public/index.php/tareas" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i><?= lang('App.back_to_tasks') ?>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i><?= lang('App.create_task') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>