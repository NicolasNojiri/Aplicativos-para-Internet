<?php
namespace service;

use dao\UserDAO;

class UserService {
    private $dao;
    public function __construct(){
        $this->dao = new UserDAO();
    }
    public function listar(){ 
        return $this->dao->listar(); 
    }
    public function inserir($nome,$email){
        if(trim($nome) == '') throw new \Exception("Nome é obrigatório");

        if(trim($email) == '') throw new \Exception("E-mail é obrigatório");

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new \Exception("E-mail inválido");

        return $this->dao->inserir(trim($nome), trim($email));
    }

    public function listarId($id){ 
        return $this->dao->listarId($id); 
    }

    public function excluir($id){
        if(empty($id)) throw new \Exception("ID do usuário é obrigatório");
        return $this->dao->deletar($id);
    }
}
