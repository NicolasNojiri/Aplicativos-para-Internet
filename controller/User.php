<?php
namespace controller;

use service\UserService;
use template\ClienteTemp;

class User {
    private $template;
    public function __construct(){
        $this->template = new ClienteTemp();
    }

    public function listar(){
        $service = new UserService();
        $resultado = $service->listar();
        $this->template->layout("\\public\\usuario\\listar.php", $resultado);
    }

    public function formulario(){
        $this->template->layout("\\public\\usuario\\form.php");
    }

    public function inserir(){
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $service = new UserService();
        $service->inserir($nome,$email);
        header("location: /mvc20251/usuario/lista");
    }
}
