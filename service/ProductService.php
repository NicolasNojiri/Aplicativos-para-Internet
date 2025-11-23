<?php
namespace service;

use dao\ProdutoDAO;

class ProductService {
    private $dao;
    public function __construct(){
        $this->dao = new ProdutoDAO();
    }

    public function listar(){ 
        try {
            return $this->dao->listar();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar produtos: " . $e->getMessage());
        }
    }

    public function inserir($nome, $descricao){
        try {
            if(trim($nome) == '') throw new \Exception("Nome do produto é obrigatório");
            if(trim($descricao) == '') throw new \Exception("Descrição do produto é obrigatória");
            if(strlen(trim($nome)) > 255) throw new \Exception("Nome do produto não pode ter mais de 255 caracteres");

            return $this->dao->inserir(trim($nome), trim($descricao));
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir produto: " . $e->getMessage());
        }
    }

    public function listarId($id){ 
        try {
            if(empty($id)) throw new \Exception("ID do produto é obrigatório");
            return $this->dao->listarId($id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar produto: " . $e->getMessage());
        }
    }

    public function alterar($id, $nome, $descricao){ 
        try {
            if(empty($id)) throw new \Exception("ID do produto é obrigatório");
            if(trim($nome) == '') throw new \Exception("Nome do produto é obrigatório");
            if(trim($descricao) == '') throw new \Exception("Descrição do produto é obrigatória");
            if(strlen(trim($nome)) > 255) throw new \Exception("Nome do produto não pode ter mais de 255 caracteres");
            
            $produto = $this->dao->listarId($id);
            if (!$produto || empty($produto)) {
                throw new \Exception("Produto não encontrado");
            }
            
            return $this->dao->alterar($id, trim($nome), trim($descricao));
        } catch (\Exception $e) {
            throw new \Exception("Erro ao alterar produto: " . $e->getMessage());
        }
    }

    public function excluir($id){
        try {
            if(empty($id)) throw new \Exception("ID do produto é obrigatório");
            
            $produto = $this->dao->listarId($id);
            if (!$produto || empty($produto)) {
                throw new \Exception("Produto não encontrado");
            }
            
            return $this->dao->deletar($id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir produto: " . $e->getMessage());
        }
    }
}
