<?php
namespace dao;

use generic\MysqlFactory;

class ProdutoDAO extends MysqlFactory {
    public function listar(){
        try {
            $sql = "select id, nome, descricao, created_at from produtos ORDER BY created_at DESC";
            return $this->banco->executar($sql);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para listar produtos: " . $e->getMessage());
        }
    }

    public function listarId($id){
        try {
            $sql = "select id, nome, descricao, created_at from produtos where id=:id";
            $param = [":id" => $id];
            $result = $this->banco->executar($sql, $param);
            return $result ? $result : null;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para buscar produto: " . $e->getMessage());
        }
    }

    public function inserir($nome, $descricao){
        try {
            $sql = "insert into produtos (nome, descricao) values (:nome, :descricao)";
            $param = [":nome"=>$nome, ":descricao"=>$descricao];
            $this->banco->executar($sql, $param);
            return $this->banco->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para inserir produto: " . $e->getMessage());
        }
    }

    public function alterar($id, $nome, $descricao){
        try {
            $sql = "update produtos set nome=:nome, descricao=:descricao where id=:id";
            $param = [":nome"=>$nome, ":descricao"=>$descricao, ":id"=>$id];
            return $this->banco->executar($sql, $param);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para alterar produto: " . $e->getMessage());
        }
    }

    public function deletar($id){
        try {
            $sql = "delete from produtos where id=:id";
            $param = [":id"=>$id];
            return $this->banco->executar($sql, $param);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para deletar produto: " . $e->getMessage());
        }
    }
}
