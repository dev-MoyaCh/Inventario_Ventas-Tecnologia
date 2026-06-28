<?php

namespace Controllers;

use Core\Controller;
use Models\Salida;
use Models\Producto;
use Exception;

class SalidaController extends Controller
{
    private Salida $model;
    private Producto $producto;

    public function __construct()
    {
        $this->model = new Salida();
        $this->producto = new Producto();
    }

    public function index(): void {
        $salidas = $this->model->getAll();
        $this->render('salidas', ['salidas' => $salidas]);
    }

    public function registrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $razon = htmlspecialchars(trim($_POST['Razon'] ?? ''));
                if (empty($razon)) {
                    throw new Exception('La razón es requerida');
                }

                $this->model->registrar(
                    (int) $_POST['ID_Producto'],
                    (int) $_POST['Cantidad'],
                    $razon
                );
                $_SESSION['mensaje'] = "✅ Salida registrada correctamente";
            } catch (Exception $e) {
                $_SESSION['error'] = "❌ Error: " . $e->getMessage();
            }

            $this->redirect('index.php?controller=salida&action=index');
            return;
        }

        $productos = $this->producto->getAll();
        $this->render('salidas_form', ['productos' => $productos]);
    }
}