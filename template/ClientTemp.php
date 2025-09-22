<?php
namespace template;

class ClientTemp implements ITemplate
{
    public function cabecalho()
    {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sistema de Feedback</title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: Arial, sans-serif; background: #f4f4f4; line-height: 1.6; }
                .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
                .header { background: #007BFF; color: white; padding: 1rem; text-align: center; margin-bottom: 20px; }
                .header h1 { margin-bottom: 0.5rem; }
                .nav { background: #0056b3; padding: 0.5rem; text-align: center; }
                .nav a { color: white; text-decoration: none; margin: 0 15px; padding: 5px 10px; border-radius: 3px; }
                .nav a:hover { background: rgba(255,255,255,0.2); }
                .content { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
                th { background: #f8f9fa; font-weight: bold; }
                tr:hover { background: #f5f5f5; }
                .btn { background: #007BFF; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; margin: 5px; border: none; cursor: pointer; }
                .btn:hover { background: #0056b3; }
                .form-group { margin-bottom: 15px; }
                label { display: block; margin-bottom: 5px; font-weight: bold; }
                input, select, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
                textarea { height: 100px; resize: vertical; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Sistema de Feedback</h1>
                <div class="nav">
                    <a href="index.php">Início</a>
                    <a href="?param=produto/lista">Produtos</a>
                    <a href="?param=usuario/lista">Usuários</a>
                    <a href="?param=feedback/lista">Feedbacks</a>
                </div>
            </div>
            <div class="container">
                <div class="content">
        <?php
    }

    public function rodape()
    {
        ?>
                </div>
            </div>
            <div style="background: #333; color: white; text-align: center; padding: 20px; margin-top: 40px;">
                <p>&copy; <?= date('Y') ?> Sistema de Feedback. Todos os direitos reservados.</p>
            </div>
        </body>
        </html>
        <?php
    }

    public function layout($caminho, $parametro = null)
    {
        $this->cabecalho();
        
        $fullPath = __DIR__ . "/.." . $caminho;
        if (file_exists($fullPath)) {
            include $fullPath;
        } else {
            echo "<div style='color: red; padding: 20px;'>";
            echo "<h3>Erro: Arquivo de view não encontrado</h3>";
            echo "<p>Caminho: " . $fullPath . "</p>";
            echo "</div>";
        }
        
        $this->rodape();
    }
}
