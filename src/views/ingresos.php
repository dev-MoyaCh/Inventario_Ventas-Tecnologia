<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📥 Historial de Ingresos</h1>
        <a href="index.php?controller=ingreso&action=registrar" class="btn btn-success">
            ➕ Nuevo Ingreso
        </a>
    </div>

    <?php if (empty($ingresos)): ?>
        <div class="alert alert-info">No hay ingresos registrados.</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingresos as $ingreso): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($ingreso['Fecha_Ingreso'])) ?></td>
                        <td><?= htmlspecialchars($ingreso['ProductoNombre']) ?></td>
                        <td><?= htmlspecialchars($ingreso['ProveedorNombre']) ?></td>
                        <td><span class="badge bg-success"><?= $ingreso['Cantidad'] ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>