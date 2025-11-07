<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <?= $data['page_title'] ?? 'Editar Rutina' ?>
                </h4>
            </div>

            <div class="card-body">
                <form method="POST" action="<?= URL ?>rutinas/update">
                    <input type="hidden" name="id" value="<?= $data['rutina']['id'] ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la rutina *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               placeholder="Ej: Correr por la mañana"
                               value="<?= htmlspecialchars($data['rutina']['nombre']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-select" id="tipo" name="tipo">
                            <?php foreach ($data['tipos'] as $tipo): ?>
                                <option value="<?= htmlspecialchars($tipo) ?>" 
                                    <?= $data['rutina']['tipo'] == $tipo ? 'selected' : '' ?>>
                                    <?= ucfirst(htmlspecialchars($tipo)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                  placeholder="Detalles de la rutina"><?= htmlspecialchars($data['rutina']['descripcion']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="duracion" class="form-label">Duración (minutos)</label>
                        <input type="number" class="form-control" id="duracion" name="duracion"
                               placeholder="Ej: 30"
                               value="<?= htmlspecialchars($data['rutina']['duracion']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="frecuencia" class="form-label">Frecuencia</label>
                        <select class="form-select" id="frecuencia" name="frecuencia">
                            <option value="diaria" <?= $data['rutina']['frecuencia'] == 'diaria' ? 'selected' : '' ?>>Diaria</option>
                            <option value="semanal" <?= $data['rutina']['frecuencia'] == 'semanal' ? 'selected' : '' ?>>Semanal</option>
                            <option value="mensual" <?= $data['rutina']['frecuencia'] == 'mensual' ? 'selected' : '' ?>>Mensual</option>
                            <option value="otra" <?= $data['rutina']['frecuencia'] == 'otra' ? 'selected' : '' ?>>Otra</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= URL ?>rutinas" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Actualizar Rutina
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>