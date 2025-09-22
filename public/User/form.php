<h2>Cadastro de Usuário</h2>
<a href="?param=usuario/lista" class="btn" style="background: #6c757d;">Voltar</a>
<form method="POST" action="?param=usuario/inserir">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required />
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />
    </div>
    <input type="submit" value="Salvar Usuário" class="btn" />
</form>
