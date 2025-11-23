<?php
namespace service;

use dao\FeedbackDAO;

class FeedbackService {
    private $dao;
    public function __construct(){
        $this->dao = new FeedbackDAO();
    }
    
    public function listar(){ 
        try {
            return $this->dao->listar();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar feedbacks: " . $e->getMessage());
        }
    }

    public function inserir($produto_id, $usuario_id, $nota, $comentario){
        try {
            if(empty($produto_id) || !is_numeric($produto_id)) throw new \Exception("Produto é obrigatório");
            if(empty($usuario_id) || !is_numeric($usuario_id)) throw new \Exception("Usuário é obrigatório"); 
            if(!(is_numeric($nota) && $nota >= 0 && $nota <= 5)) throw new \Exception("Nota inválida (0-5)");
            if(trim($comentario) == '') throw new \Exception("Comentário é obrigatório");
            if(strlen(trim($comentario)) > 1000) throw new \Exception("Comentário não pode ter mais de 1000 caracteres");
            
            return $this->dao->inserir($produto_id, $usuario_id, $nota, trim($comentario));
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir feedback: " . $e->getMessage());
        }
    }
    
    public function listarId($id){
        try {
            if(empty($id)) throw new \Exception("ID do feedback é obrigatório");
            return $this->dao->listarId($id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar feedback: " . $e->getMessage());
        }
    }
    
    public function atualizar($id, $nota, $comentario){
        try {
            if(empty($id)) throw new \Exception("ID do feedback é obrigatório");
            if(!(is_numeric($nota) && $nota >= 0 && $nota <= 5)) throw new \Exception("Nota inválida (0-5)");
            if(trim($comentario) == '') throw new \Exception("Comentário é obrigatório");
            if(strlen(trim($comentario)) > 1000) throw new \Exception("Comentário não pode ter mais de 1000 caracteres");
            
            $feedback = $this->dao->listarId($id);
            if (!$feedback || empty($feedback)) {
                throw new \Exception("Feedback não encontrado");
            }
            
            return $this->dao->atualizar($id, $nota, trim($comentario));
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar feedback: " . $e->getMessage());
        }
    }
    
    public function excluir($id){
        try {
            if(empty($id)) throw new \Exception("ID do feedback é obrigatório");
            
            $feedback = $this->dao->listarId($id);
            if (!$feedback || empty($feedback)) {
                throw new \Exception("Feedback não encontrado");
            }
            
            return $this->dao->deletar($id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir feedback: " . $e->getMessage());
        }
    }
}
