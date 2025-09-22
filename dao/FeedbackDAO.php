<?php
namespace dao\mysql;

use generic\MysqlFactory;

class FeedbackDAO extends MysqlFactory {
    public function listar(){
        $sql = "select f.id, p.nome as produto, u.nome as usuario, f.nota, f.comentario
                from feedback f
                left join produtos p on p.id = f.produto_id
                left join usuarios u on u.id = f.usuario_id";
        return $this->banco->executar($sql);
    }

    public function inserir($produto_id, $usuario_id, $nota, $comentario){
        $sql = "insert into feedback (produto_id, usuario_id, nota, comentario) 
                values (:prod, :usu, :nota, :comentario)";
        $param = [
            ":prod"=>$produto_id, 
            ":usu"=>$usuario_id, 
            ":nota"=>$nota, 
            ":comentario"=>$comentario
        ];
        $this->banco->executar($sql,$param);
        return $this->banco->lastInsertId();
    }
}
