<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>🚚 Proveedores</h1>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProveedor">
        ➕ Nuevo Proveedor
    </button>
</div>


<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Razón Social</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $prov): ?>
                    <tr>
                        <td><?= $prov['ID_Proveedor'] ?></td>
                        <td><?= htmlspecialchars($prov['Razon_Social']) ?></td>
                        <td><?= htmlspecialchars($prov['Correo'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($prov['Numero'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Nuevo Proveedor -->
<div class="modal fade" id="modalProveedor" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="index.php?controller=proveedor&action=crear" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Razón Social:</label>
                    <input type="text" name="Razon_Social" class="form-control" required maxlength="50">
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo:</label>
                    <input type="email" name="Correo" class="form-control" maxlength="50">
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono:</label>
                    <input type="text" name="Numero" class="form-control" maxlength="20">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">💾 Guardar</button>
            </div>
        </form>
    </div>
</div>