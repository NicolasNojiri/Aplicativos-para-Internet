<?php
namespace dao;

use generic\MysqlFactory;

class UserDAO extends MysqlFactory {
    public function listar(){
        try {
            $sql = "select id, nome, email, created_at from usuarios ORDER BY created_at DESC";
            return $this->banco->executar($sql);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar usuários: " . $e->getMessage());
        }
    }

    public function inserir($nome, $email, $password = null){
        try {
            if ($password) {
                $sql = "insert into usuarios (nome, email, password) values (:nome, :email, :password)";
                $param = [":nome"=>$nome, ":email"=>$email, ":password"=>$password];
            } else {
                $sql = "insert into usuarios (nome, email) values (:nome, :email)";
                $param = [":nome"=>$nome, ":email"=>$email];
            }
            
            $this->banco->executar($sql, $param);
            return $this->banco->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir usuário: " . $e->getMessage());
        }
    }

    public function listarId($id){
        try {
            $sql = "select id, nome, email, created_at from usuarios where id=:id";
            $param = [":id"=>$id];
            $result = $this->banco->executar($sql, $param);
            return $result ? $result : null;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar usuário por ID: " . $e->getMessage());
        }
    }
    
    public function buscarPorEmail($email){
        try {
            $sql = "select id, nome, email, password, created_at from usuarios where email=:email";
            $param = [":email"=>$email];
            $result = $this->banco->executar($sql, $param);
            return $result ? $result : null;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar usuário por email: " . $e->getMessage());
        }
    }
    
    public function atualizar($id, $nome, $email, $password = null){
        try {
            if ($password) {
                $sql = "update usuarios set nome=:nome, email=:email, password=:password where id=:id";
                $param = [":nome"=>$nome, ":email"=>$email, ":password"=>$password, ":id"=>$id];
            } else {
                $sql = "update usuarios set nome=:nome, email=:email where id=:id";
                $param = [":nome"=>$nome, ":email"=>$email, ":id"=>$id];
            }
            
            return $this->banco->executar($sql, $param);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar usuário: " . $e->getMessage());
        }
    }

    public function deletar($id){
        try {
            $sql = "delete from usuarios where id=:id";
            $param = [":id"=>$id];
            return $this->banco->executar($sql, $param);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar usuário: " . $e->getMessage());
        }
    }
}
