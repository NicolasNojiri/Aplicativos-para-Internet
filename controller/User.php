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
        try {
            $service = new UserService();
            $resultado = $service->listar();
            $this->template->layout("/public/User/listar.php", $resultado);
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 10px; background: #ffebee; border: 1px solid #f44336; margin: 10px; border-radius: 4px;'>";
            echo "Erro ao listar usuários: " . $e->getMessage();
            echo "</div>";
            $this->template->layout("/public/User/listar.php", []);
        }
    }

    public function formulario(){
        $this->template->layout("/public/User/form.php");
    }

    public function inserir(){
        try {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? null;
            
            $service = new UserService();
            $service->inserir($nome, $email, $password);
            header("location: ?param=usuario/lista");
            exit;
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 10px; background: #ffebee; border: 1px solid #f44336; margin: 10px; border-radius: 4px;'>";
            echo "Erro ao inserir usuário: " . $e->getMessage();
            echo "</div>";
            $this->formulario();
        }
    }

    public function excluir(){
        try {
            $id = $_GET['id'] ?? null;
            if(empty($id)) {
                throw new \Exception("ID do usuário não fornecido");
            }
            
            $service = new UserService();
            $service->excluir($id);
            
            header("location: ?param=usuario/lista");
            exit;
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 10px; background: #ffebee; border: 1px solid #f44336; margin: 10px; border-radius: 4px;'>";
            echo "Erro ao excluir usuário: " . $e->getMessage();
            echo "</div>";
            $this->listar();
        }
    }
}
