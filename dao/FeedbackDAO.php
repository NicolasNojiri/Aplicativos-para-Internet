<?php
namespace dao;

use generic\MysqlFactory;

class FeedbackDAO extends MysqlFactory {
    public function listar(){
        try {
            $sql = "select f.id, f.produto_id, f.usuario_id, p.nome as produto, u.nome as usuario, f.nota, f.comentario, f.created_at
                    from feedback f
                    left join produtos p on p.id = f.produto_id
                    left join usuarios u on u.id = f.usuario_id
                    ORDER BY f.created_at DESC";
            return $this->banco->executar($sql);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para listar feedbacks: " . $e->getMessage());
        }
    }

    public function listarId($id){
        try {
            $sql = "select f.id, f.produto_id, f.usuario_id, p.nome as produto, u.nome as usuario, f.nota, f.comentario, f.created_at
                    from feedback f
                    left join produtos p on p.id = f.produto_id
                    left join usuarios u on u.id = f.usuario_id
                    where f.id = :id";
            $param = [":id" => $id];
            $result = $this->banco->executar($sql, $param);
            return $result ? $result : null;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para buscar feedback: " . $e->getMessage());
        }
    }

    public function inserir($produto_id, $usuario_id, $nota, $comentario){
        try {
            $sql = "insert into feedback (produto_id, usuario_id, nota, comentario) 
                    values (:prod, :usu, :nota, :comentario)";
            $param = [
                ":prod"=>$produto_id, 
                ":usu"=>$usuario_id, 
                ":nota"=>$nota, 
                ":comentario"=>$comentario
            ];
            $this->banco->executar($sql, $param);
            return $this->banco->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para inserir feedback: " . $e->getMessage());
        }
    }
    
    public function atualizar($id, $nota, $comentario){
        try {
            $sql = "update feedback set nota=:nota, comentario=:comentario where id=:id";
            $param = [":nota"=>$nota, ":comentario"=>$comentario, ":id"=>$id];
            return $this->banco->executar($sql, $param);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para atualizar feedback: " . $e->getMessage());
        }
    }
    
    public function deletar($id){
        try {
            $sql = "delete from feedback where id=:id";
            $param = [":id"=>$id];
            return $this->banco->executar($sql, $param);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao acessar o banco de dados para deletar feedback: " . $e->getMessage());
        }
    }
}
