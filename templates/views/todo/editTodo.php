<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <?= $data['page_title'] ?? 'Editar Tarea' ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= URL ?>todo/update">
                    <input type="hidden" name="id" value="<?= $data['todo']['id'] ?>">
                    
                    <div class="mb-3">
                        <label for="task" class="form-label">Tarea *</label>
                        <input type="text" class="form-control" id="task" name="task" 
                               placeholder="¿Qué necesitas hacer?" value="<?= htmlspecialchars($data['todo']['task']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="3" placeholder="Detalles adicionales (opcional)"><?= htmlspecialchars($data['todo']['description']) ?></textarea>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="important" name="important" <?php if ($data['todo']['important']) echo 'checked'; ?>>
                        <label class="form-check-label" for="important">
                            Marcar tarea como importante
                        </label>
                    </div>
                    
                    <div class="mb-3">
                        <label for="priority" class="form-label">Prioridad</label>
                        <select class="form-select" id="priority" name="priority">
                            <option value="low" <?= $data['todo']['priority'] == 'low' ? 'selected' : '' ?>>🟢 Baja</option>
                            <option value="medium" <?= $data['todo']['priority'] == 'medium' ? 'selected' : '' ?>>🟡 Media</option>
                            <option value="high" <?= $data['todo']['priority'] == 'high' ? 'selected' : '' ?>>🔴 Alta</option>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= URL ?>todo" class="btn btn-outline-secondary me-md-2">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Actualizar Tarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>
