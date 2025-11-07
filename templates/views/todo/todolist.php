<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row justify-content-center mb-4">
    <div class="col-md-9
        ">
        <div class="d-flex justify-content-between align-items-center ">
            <h1 class="mb-4">
                <?= $data['page_title'] ?? 'Mi Lista de Tareas' ?>
            </h1>
            <a href="<?= URL ?>todo/add" class="btn btn-primary w-25">
                Nueva Tarea
            </a>
        </div>
        
        <!-- Barra de búsqueda -->
        <div class="mb-4">
            <form method="GET" action="<?= URL ?>todo/search" class="d-flex">
                <input type="text" class="form-control me-2" name="q" 
                    placeholder="Buscar tareas..." value="<?= $data['search_term'] ?? '' ?>">
                <button type="submit" class="btn btn-outline-secondary">Buscar</button>
            </form>
        </div>
        
        <!-- Lista de tareas -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tareas</h5>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($data['todos'])): ?>
                    <?php foreach ($data['todos'] as $todo): ?>
                        <div class="todo-item p-3 border-bottom <?= $todo['completed'] ? 'completed-task' : '' ?>">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="mb-0 me-2 <?= $todo['completed'] ? 'text-decoration-line-through text-muted' : '' ?>">
                                            <?= htmlspecialchars($todo['task']) ?>
                                        </h6>
                                        <span class="badge priority-badge bg-<?= $todo['priority_color'] ?>">
                                            <?= $todo['priority_text'] ?>
                                        </span>
                                        <span>
                                            <?php if ($todo['completed']): ?>
                                                <i class="fa-solid fa-check-circle text-success ms-2" title="Completada"></i>
                                                <strong style="color: green;">Tarea Completada</strong>
                                            <?php elseif ($todo['important']): ?>
                                                <i class="fa-solid fa-circle-exclamation text-warning ms-2" title="Importante"></i>
                                                <strong style="color: orange;">Tarea Importante</strong>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    
                                    <?php if ($todo['description']): ?>
                                        <p class="text-muted mb-2 small">
                                            <?= htmlspecialchars($todo['description']) ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <small class="text-muted">
                                        <?= $todo['formatted_date'] ?>
                                    </small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="<?= URL ?>todo/edit?id=<?= $todo['id'] ?>" 
                                        class="btn btn-sm btn-outline-primary">
                                        Editar
                                    </a>

                                    <a href="#" 
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-delete-url="<?= URL ?>todo/delete?id=<?= $todo['id'] ?>">
                                        Eliminar
                                    </a>

                                    <a href="<?= URL ?>todo/toggleCompleted?id=<?= $todo['id'] ?>" 
                                        class="btn btn-sm <?= $todo['completed'] ? 'btn-outline-success' : 'btn-success' ?>">
                                        <?= $todo['completed'] ? '✓ Completada' : 'Marcar Completada' ?>
                                    </a>

                                    <?php if (!$todo['completed']): ?>
                                        <a href="<?= URL ?>todo/toggleImportant?id=<?= $todo['id'] ?>" 
                                            class="btn btn-sm <?= $todo['important'] ? 'btn-outline-warning' : 'btn-warning' ?>" 
                                            title="<?= $todo['important'] ? 'Marcar como no importante' : 'Marcar como importante' ?>">
                                            <i class="fa-solid fa-circle-exclamation" style="color: <?= $todo['important'] ? 'orange' : 'black' ?>;"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                        <h5>No hay tareas</h5>
                        <p>
                            <?php if (isset($data['search_term'])): ?>
                                No se encontraron tareas para "<?= htmlspecialchars($data['search_term']) ?>"
                            <?php else: ?>
                                ¡Agrega tu primera tarea!
                            <?php endif; ?>
                        </p>
                        <a href="<?= URL ?>todo/add" class="btn btn-primary">
                            Nueva Tarea
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Eliminar tarea?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Esta acción no se puede deshacer. ¿Estás seguro de eliminar esta tarea?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDelete" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>