<?php
namespace service;

use dao\FeedbackDAO;

class FeedbackService {
    private $dao;
    public function __construct(){
        $this->dao = new FeedbackDAO();
    }
    public function listar(){ 
        return $this->dao->listar(); 
    }

    public function inserir($produto_id, $usuario_id, $nota, $comentario){
        if(empty($produto_id) || !is_numeric($produto_id)) throw new \Exception("Produto é obrigatório");

        if(empty($usuario_id) || !is_numeric($usuario_id)) throw new \Exception("Usuário é obrigatório"); 

        if(!(is_numeric($nota) && $nota >= 0 && $nota <= 5)) throw new \Exception("Nota inválida (0-5)");

        if(trim($comentario) == '') throw new \Exception("Comentário é obrigatório");
        
        return $this->dao->inserir($produto_id, $usuario_id, $nota, trim($comentario));
    }
}
