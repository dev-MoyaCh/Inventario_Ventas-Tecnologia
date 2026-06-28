<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>📤 Historial de Salidas</h1>
    <a href="index.php?controller=salida&action=registrar" class="btn btn-warning">
        ➕ Nueva Salida
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($salidas)): ?>
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> No hay salidas registradas.
            </div>
        <?php else: ?>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Razón</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salidas as $s): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($s['Fecha_Salida'])) ?></td>
                            <td><?= htmlspecialchars($s['ProductoNombre']) ?></td>
                            <td><span class="badge bg-warning text-dark"><?= $s['Cantidad'] ?></span></td>
                            <td><?= htmlspecialchars($s['Razon']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>