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
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sistema de Feedback - API RESTful</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: #f5f7fa;
                    min-height: 100vh;
                    padding: 40px 20px;
                }
                
                .container {
                    max-width: 1200px;
                    margin: 0 auto;
                }
                
                .header {
                    text-align: center;
                    color: #2c3e50;
                    margin-bottom: 50px;
                }
                
                .header h1 {
                    font-size: 2.5rem;
                    margin-bottom: 10px;
                    font-weight: 600;
                }
                
                .header p {
                    font-size: 1.1rem;
                    color: #7f8c8d;
                }
                
                .grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                    gap: 24px;
                    margin-bottom: 24px;
                }
                
                .card {
                    background: white;
                    border-radius: 12px;
                    padding: 28px;
                    border: 1px solid #e1e8ed;
                    transition: transform 0.2s, box-shadow 0.2s;
                }
                
                .card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 8px 24px rgba(44, 62, 80, 0.12);
                }
                
                .card h2 {
                    color: #2c3e50;
                    margin-bottom: 20px;
                    font-size: 1.4rem;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                
                .card-links {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }
                
                .btn {
                    display: block;
                    text-decoration: none;
                    padding: 12px 20px;
                    border-radius: 8px;
                    font-weight: 500;
                    text-align: center;
                    transition: all 0.2s;
                }
                
                .btn-primary {
                    background: #3498db;
                    color: white;
                }
                
                .btn-primary:hover {
                    background: #2980b9;
                }
                
                .btn-secondary {
                    background: white;
                    color: #3498db;
                    border: 2px solid #3498db;
                }
                
                .btn-secondary:hover {
                    background: #3498db;
                    color: white;
                }
                
                .btn-api {
                    background: #2c3e50;
                    color: white;
                    font-size: 1.1rem;
                    padding: 16px 28px;
                }
                
                .btn-api:hover {
                    background: #1a252f;
                }
                
                .icon {
                    font-size: 1.3rem;
                }
                
                @media (max-width: 768px) {
                    .header h1 {
                        font-size: 2rem;
                    }
                    
                    .grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Sistema de Feedback</h1>
                    <p>Plataforma completa de avaliação de produtos com API RESTful</p>
                </div>
                
                <div class="grid">
                    <div class="card">
                        <h2><span class="icon">📦</span> Produtos</h2>
                        <div class="card-links">
                            <a href="?param=produto/lista" class="btn btn-primary">Listar Produtos</a>
                            <a href="?param=produto/formulario" class="btn btn-secondary">Cadastrar Produto</a>
                        </div>
                    </div>
                    
                    <div class="card">
                        <h2><span class="icon">👥</span> Usuários</h2>
                        <div class="card-links">
                            <a href="?param=usuario/lista" class="btn btn-primary">Listar Usuários</a>
                            <a href="?param=usuario/formulario" class="btn btn-secondary">Cadastrar Usuário</a>
                        </div>
                    </div>
                    
                    <div class="card">
                        <h2><span class="icon">💬</span> Feedbacks</h2>
                        <div class="card-links">
                            <a href="?param=feedback/lista" class="btn btn-primary">Listar Feedbacks</a>
                            <a href="?param=feedback/formulario" class="btn btn-secondary">Cadastrar Feedback</a>
                        </div>
                    </div>
                </div>
                
                <div class="card" style="text-align: center;">
                    <h2><span class="icon">🔌</span> API RESTful</h2>
                    <a href="swagger.html" target="_blank" class="btn btn-api">Acessar Documentação da API</a>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
?>
