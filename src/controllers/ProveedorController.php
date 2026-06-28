<?php

namespace Controllers;

use Core\Controller;
use Models\Proveedor;
use Exception;

class ProveedorController extends Controller
{
    private Proveedor $model;

    public function __construct()
    {
        $this->model = new Proveedor();
    }

    public function index(): void {
        $proveedores = $this->model->getAll();
        $this->render('proveedores', ['proveedores' => $proveedores]);
    }

    public function crear(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar datos requeridos
                if (empty($_POST['Razon_Social']) || empty($_POST['Correo']) || empty($_POST['Numero'])) {
                    throw new Exception('Todos los campos son requeridos');
                }

                // Validar formato de email
                if (!filter_var($_POST['Correo'], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception('El correo electrónico no es válido');
                }

                // Validar que el número sea válido
                $numero = trim($_POST['Numero']);
                if (strlen($numero) < 7) {
                    throw new Exception('El número de teléfono debe tener al menos 7 dígitos');
                }

                $this->model->create([
                    'Razon_Social' => htmlspecialchars(trim($_POST['Razon_Social'])),
                    'Correo'       => htmlspecialchars(trim($_POST['Correo'])),
                    'Numero'       => htmlspecialchars($numero),
                ]);

                $_SESSION['mensaje'] = '✅ Proveedor creado correctamente';
            } catch (Exception $e) {
                $_SESSION['error'] = '❌ Error: ' . $e->getMessage();
            }
        }

        $this->redirect('index.php?controller=proveedor&action=index');
    }
}