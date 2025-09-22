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
        $classe = "controller\\" . $this->classe;   // 🔴 Aqui ele monta o nome completo
        $obj = new $classe();                      // Tenta instanciar
        $metodo = $this->metodo;
        $obj->$metodo();
    }
}
