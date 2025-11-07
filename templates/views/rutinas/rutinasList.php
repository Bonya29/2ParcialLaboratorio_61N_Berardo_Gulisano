<?php require_once INCLUDES.'inc_header.php'; ?>
<?= Toast::flash() ?>

<!-- Mostrar notificaciones toast -->

<div class="row justify-content-center mb-4">
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><?= $data['page_title'] ?? 'Listado de Rutinas' ?></h1>
            <a href="<?= URL ?>rutinas/add" class="btn btn-primary w-25">Nueva Rutina</a>
        </div>

        <!-- Lista de Rutinas -->

        <div class="card">
            <div class="card-header"><h5>Rutinas</h5></div>
            <div class="card-body p-0">
                <?php if(!empty($data['rutinas'])): ?>
                    <?php foreach($data['rutinas'] as $rutina): ?>
                        <div class="p-3 border-bottom d-flex align-items-start justify-content-between">
                            <div class="flex-grow-1">
                                <h6>
                                    <?= htmlspecialchars($rutina['nombre']) ?>
                                    <span class="badge bg-<?= $rutina['tipo_color'] ?> ms-2"><?= ucfirst($rutina['tipo']) ?></span>
                                    <span class="badge bg-secondary ms-1"><?= $rutina['frecuencia_text'] ?></span>
                                </h6>
                                <?php if($rutina['descripcion']): ?>
                                    <p class="text-muted small mb-0"><?= htmlspecialchars($rutina['descripcion']) ?></p>
                                <?php endif; ?>
                                <small class="text-muted">Duración: <?= $rutina['duracion_text'] ?></small>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <a href="<?= URL ?>rutinas/edit?id=<?= $rutina['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-delete-url="<?= URL ?>rutinas/delete?id=<?= $rutina['id'] ?>">Eliminar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                        <h5>No hay rutinas</h5>
                        <p><?= isset($data['search_term']) ? 'No se encontraron rutinas para "'.htmlspecialchars($data['search_term']).'"' : '¡Agrega tu primera rutina!' ?></p>
                        <a href="<?= URL ?>rutinas/add" class="btn btn-primary">Nueva Rutina</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5>¿Eliminar rutina?</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">Esta acción no se puede deshacer. ¿Estás seguro de eliminar esta rutina?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDelete" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES.'inc_footer.php'; ?>