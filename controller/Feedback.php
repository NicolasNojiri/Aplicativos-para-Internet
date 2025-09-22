<?php
namespace controller;

use service\FeedbackService;
use service\ProductService;
use service\UserService;
use template\ClientTemp;

class Feedback {
    private $template;
    public function __construct(){
        $this->template = new ClientTemp();
    }

    public function listar(){
        $service = new FeedbackService();
        $resultado = $service->listar();
        $this->template->layout("/public/Feedback/listar.php", $resultado);
    }

    public function formulario(){
        $ps = new ProductService();
        $us = new UserService();
        $produtos = $ps->listar();
        $usuarios = $us->listar();
        $params = ['produtos'=>$produtos,'usuarios'=>$usuarios];
        $this->template->layout("/public/Feedback/form.php", $params);
    }

    public function inserir(){
        try {
            $produto = $_POST['produto'] ?? null;
            $usuario = $_POST['usuario'] ?? null;
            $nota = $_POST['nota'] ?? 0;
            $comentario = $_POST['comentario'] ?? '';
            $service = new FeedbackService();
            $service->inserir($produto, $usuario, $nota, $comentario);
            header("location: ?param=feedback/lista");
            exit;
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 10px; background: #ffebee; border: 1px solid #f44336; margin: 10px; border-radius: 4px;'>";
            echo "Erro: " . $e->getMessage();
            echo "</div>";
            $this->formulario();
        }
    }
}
