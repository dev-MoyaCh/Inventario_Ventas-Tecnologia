<?php

namespace Models;

use Core\Model;
use Exception;

class Salida extends Model {
    protected string $table = 'Salidas';
    protected string $primaryKey = 'ID_Salida';

    public function getAll(): array {
        $stmt = $this->db->query("
            SELECT s.*, p.Nombre as ProductoNombre
            FROM Salidas s
            INNER JOIN Productos p ON s.ID_Producto = p.ID_Producto
            ORDER BY s.Fecha_Salida DESC
        ");
        return $stmt->fetchAll();
    }

    public function registrar(int $productoId, int $cantidad, string $razon): int {
        // Validar stock suficiente
        $stmtProducto = $this->db->prepare("SELECT Stock FROM Productos WHERE ID_Producto = :id");
        $stmtProducto->execute(['id' => $productoId]);
        $producto = $stmtProducto->fetch();

        if (!$producto || $producto['Stock'] < $cantidad) {
            throw new Exception("Stock insuficiente. Disponible: " . ($producto['Stock'] ?? 0));
        }

        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO Salidas (ID_Producto, Cantidad, Razon, Fecha_Salida) 
                 VALUES (:producto, :cantidad, :razon, NOW())"
            );
            $stmt->execute([
                'producto' => $productoId,
                'cantidad' => $cantidad,
                'razon'    => $razon
            ]);
            $id = (int) $this->db->lastInsertId();

            // Descontar stock
            $stmtStock = $this->db->prepare(
                "UPDATE Productos SET Stock = Stock - :cantidad WHERE ID_Producto = :id"
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
        $stmt = $this->db->query("SELECT COALESCE(SUM(Cantidad), 0) as total FROM Salidas");
        return (int) $stmt->fetch()['total'];
    }
}