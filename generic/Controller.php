<?php
namespace generic;

class Controller{
    private $arrChamadas=[];
    public function __construct()
    {
        $this->arrChamadas = [
          
            // Produtos
            "produto/lista" => new Acao("Produto","listar"),
            "produto/formulario" => new Acao("Produto","formulario"),
            "produto/formularioalterar" => new Acao("Produto","alterarForm"),
            "produto/inserir" => new Acao("Produto","inserir"),
            "produto/excluir" => new Acao("Produto","excluir"),
            // Usuarios
            "usuario/lista" => new Acao("User","listar"),
            "usuario/formulario" => new Acao("User","formulario"),
            "usuario/inserir" => new Acao("User","inserir"),
            "usuario/excluir" => new Acao("User","excluir"),
            // Feedback
            "feedback/lista" => new Acao("Feedback","listar"),
            "feedback/formulario" => new Acao("Feedback","formulario"),
            "feedback/inserir" => new Acao("Feedback","inserir"),
        ];
    }

    public function verificarChamadas($rota){
        if(isset($this->arrChamadas[$rota])){
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return;
        }
        echo 'Rota nao existe!';
    }
}
