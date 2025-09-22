<?php
namespace dao\mysql;

use generic\MysqlFactory;

class ProdutoDAO extends MysqlFactory {
    public function listar(){
        $sql = "select id, nome, descricao from produtos";
        return $this->banco->executar($sql);
    }

    public function listarId($id){
        $sql = "select id, nome, descricao from produtos where id=:id";
        $param = [":id" => $id];
        return $this->banco->executar($sql,$param);
    }

    public function inserir($nome, $descricao){
        $sql = "insert into produtos (nome,descricao) values (:nome,:descricao)";
        $param = [":nome"=>$nome, ":descricao"=>$descricao];
        $this->banco->executar($sql,$param);
        return $this->banco->lastInsertId();
    }

    public function alterar($id,$nome,$descricao){
        $sql = "update produtos set nome=:nome, descricao=:descricao where id=:id";
        $param = [":nome"=>$nome, ":descricao"=>$descricao, ":id"=>$id];
        return $this->banco->executar($sql,$param);
    }

    public function deletar($id){
        $sql = "delete from produtos where id=:id";
        $param = [":id"=>$id];
        return $this->banco->executar($sql,$param);
    }
}
