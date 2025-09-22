<?php
namespace service;

use dao\mysql\FeedbackDAO;

class FeedbackService {
    private $dao;
    public function __construct(){
        $this->dao = new FeedbackDAO();
    }
    public function listar(){ return $this->dao->listar(); }
    public function inserir($produto_id, $usuario_id, $nota, $comentario){
        if(!(is_numeric($nota) && $nota >= 0 && $nota <= 5)) 
            throw new \Exception("Nota inválida (0-5)");
        return $this->dao->inserir($produto_id, $usuario_id, $nota, $comentario);
    }
}
