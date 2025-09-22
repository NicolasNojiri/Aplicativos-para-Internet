<?php
namespace generic;

class MysqlSingleton{
    private static $instance = null;
    private $conexao = null;
    private $dsn = 'mysql:host=localhost;dbname=feedback_db;charset=utf8';
    private $usuario = 'root';
    private $senha = '';

    private function __construct(){
        try{
            $this->conexao = new \PDO($this->dsn, $this->usuario, $this->senha);
            $this->conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e){
            echo "Erro ao conectar ao banco: " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new MysqlSingleton();
        }
        return self::$instance;
    }

    public function executar($query, $param = array()){
        if($this->conexao){
            $sth = $this->conexao->prepare($query);
            foreach($param as $k => $v){
                $sth->bindValue($k, $v);
            }
            $sth->execute();
            try {
                return $sth->fetchAll(\PDO::FETCH_ASSOC);
            } catch(\Exception $e){
                return [];
            }
        }
        return [];
    }

    public function lastInsertId(){
        if($this->conexao){
            return $this->conexao->lastInsertId();
        }
        return null;
    }
}
