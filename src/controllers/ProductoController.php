<?php

namespace Controllers;

use Core\Controller;
use Models\Producto;
use Exception;

class ProductoController extends Controller
{
    private Producto $model;

    public function __construct()
    {
        $this->model = new Producto();
    }

    public function index(): void
    {
        $productos = $this->model->getAll();
        $this->render('productos', ['productos' => $productos]);
    }

    public function crear(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar datos requeridos
                if (empty($_POST['Nombre']) || empty($_POST['Stock']) || empty($_POST['Precio'])) {
                    throw new Exception('Todos los campos son requeridos');
                }

                $stock = (int) $_POST['Stock'];
                $precio = (float) $_POST['Precio'];

                if ($stock < 0 || $precio < 0) {
                    throw new Exception('Stock y Precio deben ser valores positivos');
                }

                $this->model->create([
                    'Nombre' => htmlspecialchars(trim($_POST['Nombre'])),
                    'Stock'  => $stock,
                    'Precio' => $precio,
                ]);

                $_SESSION['mensaje'] = '✅ Producto creado correctamente';
            } catch (Exception $e) {
                $_SESSION['error'] = '❌ Error: ' . $e->getMessage();
            }

            $this->redirect('index.php?controller=producto&action=index');
            return;
        }
    }

    
}