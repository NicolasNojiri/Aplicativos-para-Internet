<?php
namespace controller;

use service\ProductService;
use template\ClienteTemp;

class Produto {
    private $template;
    public function __construct(){
        $this->template = new ClienteTemp();
    }

    public function listar(){
        $service = new ProductService();
        $resultado = $service->listar();
        $this->template->layout("\\public\\produto\\listar.php", $resultado);
    }

    public function formulario(){
        $this->template->layout("\\public\\produto\\form.php");
    }

    public function inserir(){
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $service = new ProductService();
        $service->inserir($nome,$descricao);
        header("location: /mvc20251/produto/lista");
    }

    public function alterarForm(){
        $id = $_GET['id'] ?? null;
        $service = new ProductService();
        $resultado = $service->listarId($id);
        $this->template->layout("\\public\\produto\\form.php", $resultado);
    }
}
