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
    <div class="form-group">
        <label for="password">Senha (opcional para usuários existentes):</label>
        <input type="password" id="password" name="password" placeholder="Deixe em branco se não quiser definir senha" />
        <small style="color: #666;">Mínimo 6 caracteres se informado</small>
    </div>
    <input type="submit" value="Salvar Usuário" class="btn" />
</form>
