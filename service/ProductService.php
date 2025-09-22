<?php
namespace service;

use dao\mysql\ProdutoDAO;

class ProductService {
    private $dao;
    public function __construct(){
        $this->dao = new ProdutoDAO();
    }
    public function listar(){ return $this->dao->listar(); }
    public function inserir($nome,$descricao){
        if(trim($nome) == '') throw new \Exception("Nome do produto é obrigatório");
        return $this->dao->inserir($nome,$descricao);
    }
    public function listarId($id){ return $this->dao->listarId($id); }
    public function alterar($id,$nome,$descricao){ return $this->dao->alterar($id,$nome,$descricao); }
}
