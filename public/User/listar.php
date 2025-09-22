<h2>Lista de Usuários</h2>
<a href="?param=usuario/formulario" class="btn">Novo Usuário</a>
<table>
    <tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>
<?php if($parametro && count($parametro) > 0): ?>
    <?php foreach($parametro as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id']) ?></td>
        <td><?= htmlspecialchars($p['nome']) ?></td>
        <td><?= htmlspecialchars($p['email']) ?></td>
        <td>
            <a href="?param=usuario/excluir&id=<?= $p['id'] ?>" class="btn" style="background: #dc3545;" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4" style="text-align: center; color: #666;">Nenhum usuário cadastrado</td>
    </tr>
<?php endif; ?>
</table>
