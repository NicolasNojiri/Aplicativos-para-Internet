<h2>Cadastro de Produto</h2>
<a href="?param=produto/lista" class="btn" style="background: #6c757d;">Voltar</a>
<form method="POST" action="?param=produto/inserir">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required />
    </div>
    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
    </div>
    <input type="submit" value="Salvar Produto" class="btn" />
</form>
