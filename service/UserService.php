<?php
namespace service;

use dao\mysql\UserDAO;

class UserService {
    private $dao;
    public function __construct(){
        $this->dao = new UserDAO();
    }
    public function listar(){ return $this->dao->listar(); }
    public function inserir($nome,$email){
        if(trim($nome) == '' || trim($email) == '') 
            throw new \Exception("Nome e e-mail são obrigatórios");
        return $this->dao->inserir($nome,$email);
    }
    public function listarId($id){ return $this->dao->listarId($id); }
}
