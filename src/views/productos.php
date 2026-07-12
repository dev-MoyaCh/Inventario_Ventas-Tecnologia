<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📦 Productos</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
        ➕ Nuevo Producto
    </button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?= $p['ID_Producto'] ?></td>
                        <td><?= htmlspecialchars($p['Nombre']) ?></td>
                        <td>
                            <span class="badge bg-<?= $p['Stock'] < 5 ? 'danger' : 'success' ?>">
                                <?= $p['Stock'] ?>
                            </span>
                        </td>
                        <td>$<?= number_format($p['Precio'], 2) ?></td>
                        <td>
                            <a href="index.php?controller=producto&action=eliminar&id=<?= $p['ID_Producto'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Eliminar este producto?')">
                                🗑️
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Nuevo Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="index.php?controller=producto&action=crear" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="Nombre" class="form-control" required maxlength="50">
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock inicial:</label>
                    <input type="number" name="Stock" class="form-control" min="0" value="0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio:</label>
                    <input type="number" name="Precio" class="form-control" step="0.01" min="0" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">💾 Guardar</button>
            </div>
        </form>
    </div>
</div>