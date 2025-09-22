<?php
namespace controller;

use service\ProductService;
use template\ClientTemp;

class Produto {
    private $template;
    public function __construct(){
        $this->template = new ClientTemp();
    }

    public function listar(){
        $service = new ProductService();
        $resultado = $service->listar();
        $this->template->layout("/public/Produto/listar.php", $resultado);
    }

    public function formulario(){
        $this->template->layout("/public/Produto/form.php");
    }

    public function inserir(){
        try {
            $nome = $_POST['nome'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $service = new ProductService();
            $service->inserir($nome,$descricao);
            header("location: ?param=produto/lista");
            exit;
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 10px; background: #ffebee; border: 1px solid #f44336; margin: 10px; border-radius: 4px;'>";
            echo "Erro: " . $e->getMessage();
            echo "</div>";
            $this->formulario();
        }
    }

    public function alterarForm(){
        $id = $_GET['id'] ?? null;
        $service = new ProductService();
        $resultado = $service->listarId($id);
        $this->template->layout("/public/Produto/form.php", $resultado);
    }

    public function excluir(){
        try {
            $id = $_GET['id'] ?? null;
            if(empty($id)) {
                throw new \Exception("ID do produto não fornecido");
            }
            
            $service = new ProductService();
            $service->excluir($id);
            
            header("location: ?param=produto/lista");
            exit;
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 10px; background: #ffebee; border: 1px solid #f44336; margin: 10px; border-radius: 4px;'>";
            echo "Erro ao excluir produto: " . $e->getMessage();
            echo "</div>";
            $this->listar();
        }
    }
}
