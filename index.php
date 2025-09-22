<?php
    include "generic/Autoload.php";

    use generic\Controller;

    if (isset($_GET["param"])) {
        $controller = new Controller();
        $controller->verificarChamadas($_GET["param"]);
    } else {
        
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Sistema de Feedback</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background: #f4f4f4;
                    padding: 20px;
                }
                h1 {
                    color: #333;
                }
                ul {
                    list-style: none;
                    padding: 0;
                }
                li {
                    margin: 10px 0;
                }
                a {
                    text-decoration: none;
                    background: #007BFF;
                    color: white;
                    padding: 8px 12px;
                    border-radius: 5px;
                    transition: 0.3s;
                }
                a:hover {
                    background: #0056b3;
                }
            </style>
        </head>
        <body>
            <h1>Bem-vindo ao Sistema de Feedback</h1>
            <p>Escolha uma das funcionalidades abaixo:</p>
            <ul>
                
                <li><a href="produto/lista">Listar Produtos</a></li>
                <li><a href="produto/formulario">Cadastrar Produto</a></li>
                <li><a href="usuario/lista">Listar Usuários</a></li>
                <li><a href="usuario/formulario">Cadastrar Usuário</a></li>
                <li><a href="feedback/lista">Listar Feedbacks</a></li>
                <li><a href="feedback/formulario">Cadastrar Feedback</a></li>
            </ul>
        </body>
        </html>
        <?php
    }
?>
