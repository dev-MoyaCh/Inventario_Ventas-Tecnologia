<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>💰 Historial de Ventas</h1>
    <a href="index.php?controller=venta&action=registrar" class="btn btn-primary">
        ➕ Nueva Venta
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($ventas)): ?>
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> No hay ventas registradas.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>ID Venta</th>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalGeneral = 0;
                        foreach ($ventas as $venta): 
                            $totalGeneral += $venta['Total'];
                        ?>
                            <tr>
                                <td><span class="badge bg-secondary">#<?= $venta['ID_Venta'] ?></span></td>
                                <td><?= date('d/m/Y H:i', strtotime($venta['Fecha_Venta'])) ?></td>
                                <td><?= htmlspecialchars($venta['ProductoNombre']) ?></td>
                                <td><span class="badge bg-info text-dark"><?= $venta['Cantidad'] ?> unid.</span></td>
                                <td><strong>S/<?= number_format($venta['Total'], 2) ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end">Total General:</th>
                            <th><strong class="text-success">S/<?= number_format($totalGeneral, 2) ?></strong></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="mt-3">
                <small class="text-muted">
                    <i class="bi bi-receipt"></i> Total de ventas: <?= count($ventas) ?>
                </small>
            </div>
        <?php endif; ?>
    </div>
</div>