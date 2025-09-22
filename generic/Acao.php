<?php
namespace generic;

class Acao {
    private $classe;
    private $metodo;

    public function __construct($classe, $metodo){
        $this->classe = $classe;
        $this->metodo = $metodo;
    }

    public function executar(){
        try {
            $classe = "controller\\" . $this->classe;
            
            if(!class_exists($classe)) {
                throw new \Exception("Classe não encontrada: " . $classe);
            }
            
            $obj = new $classe();
            $metodo = $this->metodo;
            
            if(!method_exists($obj, $metodo)) {
                throw new \Exception("Método não encontrado: " . $metodo . " na classe " . $classe);
            }
            
            $obj->$metodo();
        } catch(\Exception $e) {
            echo "<div style='color: red; padding: 20px; background: #ffebee; border: 1px solid #f44336; margin: 20px; border-radius: 4px;'>";
            echo "<h3>Erro na execução:</h3>";
            echo "<p><strong>Mensagem:</strong> " . $e->getMessage() . "</p>";
            echo "<p><strong>Arquivo:</strong> " . $e->getFile() . "</p>";
            echo "<p><strong>Linha:</strong> " . $e->getLine() . "</p>";
            echo "<p><strong>Classe tentada:</strong> controller\\" . $this->classe . "</p>";
            echo "<p><strong>Método tentado:</strong> " . $this->metodo . "</p>";
            echo "</div>";
        }
    }
}
