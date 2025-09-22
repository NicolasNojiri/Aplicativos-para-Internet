<?php
namespace controller;

use service\UserService;
use template\ClientTemp;

class User {
    private $template;
    public function __construct(){
        $this->template = new ClientTemp();
    }

    public function listar(){
        $service = new UserService();
        $resultado = $service->listar();
        $this->template->layout("/public/User/listar.php", $resultado);
    }

    public function formulario(){
        $this->template->layout("/public/User/form.php");
    }

    public function inserir(){
        try {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $service = new UserService();
            $service->inserir($nome,$email);
            header("location: ?param=usuario/lista");
            exit;
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 10px; background: #ffebee; border: 1px solid #f44336; margin: 10px; border-radius: 4px;'>";
            echo "Erro: " . $e->getMessage();
            echo "</div>";
            $this->formulario();
        }
    }
}
