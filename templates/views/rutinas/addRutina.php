<?php require_once INCLUDES . 'inc_header.php'; ?>

<!-- Mostrar notificaciones toast -->
<?= Toast::flash() ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <?= $data['page_title'] ?? 'Nueva Rutina' ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= URL ?>rutinas/store">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de tu rutina" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo *</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="">Selecciona un tipo de rutina</option>
                            <option value="ejercicio">Ejercicio</option>
                            <option value="meditacion">Meditación</option>
                            <option value="estudio">Estudio</option>
                            <option value="trabajo">Trabajo</option>
                            <option value="compras">Compras</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Detalles de tu rutina" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="duracion" class="form-label">Duración *</label>
                        <input type="number" class="form-control" id="duracion" name="duracion" placeholder="Duración de tu rutina (en minutos)" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="frecuencia" class="form-label">Frecuencia *</label>
                        <select class="form-select" id="frecuencia" name="frecuencia" required>
                            <option value="">Selecciona la frecuencia con la que realizas tu rutina</option>
                            <option value="diaria">Todos los días</option>
                            <option value="de por medio">Día de por medio</option>
                            <option value="semanal">Una vez a la semana</option>
                            <option value="mensual">Una vez al mes</option>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= URL ?>rutinas" class="btn btn-outline-secondary me-md-2">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Guardar Rutina
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once INCLUDES . 'inc_footer.php'; ?>
