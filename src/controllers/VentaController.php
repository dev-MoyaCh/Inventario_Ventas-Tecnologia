<?php

namespace Controllers;

use Core\Controller;
use Models\Venta;
use Models\Producto;
use Exception;

class VentaController extends Controller
{
    private Venta $model;
    private Producto $producto;

    public function __construct()
    {
        $this->model = new Venta();
        $this->producto = new Producto();
    }

    public function index(): void {
        $ventas = $this->model->getAll();
        $this->render('ventas', ['ventas' => $ventas]);
    }

    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $productoId = (int) ($_POST['ID_Producto'] ?? 0);
                $cantidad = (int) ($_POST['Cantidad'] ?? 0);
                
                if ($productoId <= 0 || $cantidad <= 0) {
                    throw new Exception('Producto y cantidad son requeridos');
                }

                // Calcular total
                $producto = $this->producto->findById($productoId);
                if (!$producto) {
                    throw new Exception('El producto no existe');
                }
                $total = $cantidad * $producto['Precio'];

                $this->model->registrar($productoId, $cantidad, $total);
                $_SESSION['mensaje'] = "✅ Venta registrada correctamente. Total: $$total";
            } catch (Exception $e) {
                $_SESSION['error'] = "❌ Error: " . $e->getMessage();
            }

            $this->redirect('index.php?controller=venta&action=index');
            return;
        }

        $productos = $this->producto->getAll();
        $this->render('ventas_form', ['productos' => $productos]);
    }
}
