<?php
namespace service;

use dao\ProdutoDAO;

class ProductService {
    private $dao;
    public function __construct(){
        $this->dao = new ProdutoDAO();
    }

    public function listar(){ 
        return $this->dao->listar(); 
    }

    public function inserir($nome,$descricao){
        if(trim($nome) == '') throw new \Exception("Nome do produto é obrigatório");

        if(trim($descricao) == '') throw new \Exception("Descrição do produto é obrigatória");

        return $this->dao->inserir(trim($nome), trim($descricao));
    }

    public function listarId($id){ 
        return $this->dao->listarId($id); 
    }

    public function alterar($id,$nome,$descricao){ 
        return $this->dao->alterar($id,$nome,$descricao); 
    }

    public function excluir($id){
        if(empty($id)) throw new \Exception("ID do produto é obrigatório");
        return $this->dao->deletar($id);
    }
}
