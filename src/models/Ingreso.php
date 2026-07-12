<?php

namespace Models;

use Core\Model;
use Exception;

class Ingreso extends Model {
    protected string $table = 'Ingresos';
    protected string $primaryKey = 'ID_Ingreso';

    public function getAll(): array {
        $stmt = $this->db->query("
            SELECT i.*, p.Nombre as ProductoNombre, pr.Razon_Social as ProveedorNombre
            FROM Ingresos i
            INNER JOIN Productos p ON i.ID_Producto = p.ID_Producto
            INNER JOIN Proveedores pr ON i.ID_Proveedor = pr.ID_Proveedor
            ORDER BY i.Fecha_Ingreso ASC
        ");
        return $stmt->fetchAll();
    }

    public function registrar(int $productoId, int $proveedorId, int $cantidad): int {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO Ingresos (ID_Producto, ID_Proveedor, Cantidad, Fecha_Ingreso) 
                 VALUES (:producto, :proveedor, :cantidad, NOW())"
            );
            $stmt->execute([
                'producto'  => $productoId,
                'proveedor' => $proveedorId,
                'cantidad'  => $cantidad
            ]);
            $id = (int) $this->db->lastInsertId();

            // Actualizar stock del producto
            $stmtStock = $this->db->prepare(
                "UPDATE Productos SET Stock = Stock + :cantidad WHERE ID_Producto = :id"
            );
            $stmtStock->execute(['cantidad' => $cantidad, 'id' => $productoId]);

            $this->db->commit();
            return $id;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getTotalUnidades(): int {
        $stmt = $this->db->query("SELECT COALESCE(SUM(Cantidad), 0) as total FROM Ingresos");
        return (int) $stmt->fetch()['total'];
    }
}
