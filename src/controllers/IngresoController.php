<?php

namespace Controllers;

use Core\Controller;
use Models\Ingreso;
use Models\Producto;
use Models\Proveedor;

class IngresoController extends Controller
{
    private Ingreso $ingreso;
    private Producto $producto;
    private Proveedor $proveedor;

    public function __construct()
    {
        $this->ingreso = new Ingreso();
        $this->producto = new Producto();
        $this->proveedor = new Proveedor();
    }

    public function index(): void
    {
        $ingresos = $this->ingreso->getAll();
        $this->render('ingresos', ['ingresos' => $ingresos]);
    }

    public function registrar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $productoId = (int) ($_POST['ID_Producto'] ?? 0);
                $proveedorId = (int) ($_POST['ID_Proveedor'] ?? 0);
                $cantidad = (int) ($_POST['Cantidad'] ?? 0);
                
                if ($productoId <= 0 || $proveedorId <= 0 || $cantidad <= 0) {
                    throw new Exception('Todos los campos son requeridos y deben ser positivos');
                }

                $this->ingreso->registrar($productoId, $proveedorId, $cantidad);
                $_SESSION['mensaje'] = "✅ Ingreso registrado correctamente";
            } catch (Exception $e) {
                $_SESSION['error'] = "❌ Error: " . $e->getMessage();
            }

            $this->redirect('index.php?controller=ingreso&action=index');
            return;
        }

        $productos = $this->producto->getAll();
        $proveedores = $this->proveedor->getAll();
        $this->render('ingresos_form', [
            'productos'   => $productos,
            'proveedores' => $proveedores,
        ]);
    }
}
