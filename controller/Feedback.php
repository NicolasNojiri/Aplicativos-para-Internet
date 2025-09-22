<?php
namespace controller;

use service\FeedbackService;
use service\ProductService;
use service\UserService;
use template\ClienteTemp;

class Feedback {
    private $template;
    public function __construct(){
        $this->template = new ClienteTemp();
    }

    public function listar(){
        $service = new FeedbackService();
        $resultado = $service->listar();
        $this->template->layout("\\public\\feedback\\listar.php", $resultado);
    }

    public function formulario(){
        $ps = new ProductService();
        $us = new UserService();
        $produtos = $ps->listar();
        $usuarios = $us->listar();
        $params = ['produtos'=>$produtos,'usuarios'=>$usuarios];
        $this->template->layout("\\public\\feedback\\form.php", $params);
    }

    public function inserir(){
        $produto = $_POST['produto'] ?? null;
        $usuario = $_POST['usuario'] ?? null;
        $nota = $_POST['nota'] ?? 0;
        $comentario = $_POST['comentario'] ?? '';
        $service = new FeedbackService();
        $service->inserir($produto, $usuario, $nota, $comentario);
        header("location: /mvc20251/feedback/lista");
    }
}
