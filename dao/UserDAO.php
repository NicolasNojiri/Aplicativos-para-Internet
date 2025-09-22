<?php
namespace dao;

use generic\MysqlFactory;

class UserDAO extends MysqlFactory {
    public function listar(){
        $sql = "select id, nome, email from usuarios";
        return $this->banco->executar($sql);
    }

    public function inserir($nome, $email){
        $sql = "insert into usuarios (nome,email) values (:nome,:email)";
        $param = [":nome"=>$nome, ":email"=>$email];
        $this->banco->executar($sql,$param);
        return $this->banco->lastInsertId();
    }

    public function listarId($id){
        $sql = "select id, nome, email from usuarios where id=:id";
        $param = [":id"=>$id];
        return $this->banco->executar($sql,$param);
    }

    public function deletar($id){
        $sql = "delete from usuarios where id=:id";
        $param = [":id"=>$id];
        return $this->banco->executar($sql,$param);
    }
}
