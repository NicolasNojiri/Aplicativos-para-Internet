<?php
namespace generic;

class MysqlSingleton{
    private static $instance = null;
    private $conexao = null;

    private function __construct(){
        try{
            $config = include __DIR__ . '/../config.php';
            $db = $config['database'];
            
            $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset={$db['charset']}";
            $this->conexao = new \PDO($dsn, $db['username'], $db['password']);
            $this->conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conexao->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
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
