<?php

namespace Models;

use Core\Model;

class Proveedor extends Model {
    protected string $table = 'Proveedores';
    protected string $primaryKey = 'ID_Proveedor';

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM Proveedores ORDER BY Razon_Social ASC");
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM Proveedores WHERE ID_Proveedor = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int {
        $stmt = $this->db->prepare(
            "INSERT INTO Proveedores (Razon_Social, Correo, Numero) 
             VALUES (:razon, :correo, :numero)"
        );
        $stmt->execute([
            'razon'   => $data['Razon_Social'],
            'correo'  => $data['Correo'],
            'numero'  => $data['Numero']
        ]);
        return (int) $this->db->lastInsertId();
    }
}