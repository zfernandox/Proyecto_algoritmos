<?= $this->include('layouts/header') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i>
                        <?= lang('App.users') ?>
                    </h4>
                    <a href="<?= site_url('/users/crear') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        <?= lang('App.new_user') ?>
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Mensajes -->
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Barra de búsqueda y filtros -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="<?= lang('App.search_user') ?>">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    
                </div>

                <!-- Tabla de usuarios -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th><?= lang('App.name') ?></th>
                                <th><?= lang('App.email') ?></th>
                                <th><?= lang('App.role') ?></th>
                                <th><?= lang('App.status') ?></th>
                                <th><?= lang('App.created_at') ?></th> 
                                <th><?= lang('App.edit') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Usuario 1 -->
                            <tr>
                            <td>1</td>
                            <td>Margarita Profesora</td>
                            <td>margarita@escuela.com</td>
                            <td>
                                <span class="badge bg-primary"><?= lang('App.teacher') ?></span>
                            </td>
                            <td>
                                <span class="badge bg-success"><?= lang('App.active') ?></span>
                            </td>
                            <td>
                                <small class="text-muted">15/03/2024</small>
                                <br>
                                <small class="text-muted">10:30 AM</small>
                            </td>
                            <td>
                                <a href="<?= site_url('/users/editar/1') ?>" class="btn btn-sm btn-outline-primary me-1" title="<?= lang('App.edit') ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                                                    
                            <!-- Usuario 2 -->
                            <tr>
                                <td>2</td>
                                
                                <td>Carlos Alumno</td>
                                <td>carlos@escuela.com</td>
                                <td>
                                    <span class="badge bg-success"><?= lang('App.student') ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-success"><?= lang('App.active') ?></span>
                                </td>
                                 <td>
                                    <small class="text-muted">15/03/2024</small>
                                    <br>
                                    <small class="text-muted">10:30 AM</small>
                                </td>
                                <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= site_url('/users/editar/1') ?>" class="btn btn-outline-primary" title="<?= lang('App.edit') ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                </td>
                                
                                
                            </tr>
                            
                            <!-- Usuario 3 -->
                            <tr>
                                <td>3</td>
                                
                                <td>Ana Profesora</td>
                                <td>ana@escuela.com</td>
                                <td>
                                    <span class="badge bg-primary"><?= lang('App.teacher') ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-warning"><?= lang('App.inactive') ?></span>
                                </td>
                                <td>
                                    <small class="text-muted">15/03/2024</small>
                                    <br>
                                    <small class="text-muted">10:30 AM</small>
                                </td>
                                 <td>
                                <!-- 🆕 BOTÓN EDITAR CON ENLACE -->
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= site_url('/users/editar/1') ?>" class="btn btn-outline-primary" title="<?= lang('App.edit') ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#"><?= lang('App.previous') ?></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><?= lang('App.next') ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer') ?>