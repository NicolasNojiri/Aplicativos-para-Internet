<h2>Lista de Produtos</h2>
<a href="?param=produto/formulario" class="btn">Novo Produto</a>
<table>
    <tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Ações</th></tr>
<?php if($parametro && count($parametro) > 0): ?>
    <?php foreach($parametro as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id']) ?></td>
        <td><?= htmlspecialchars($p['nome']) ?></td>
        <td><?= htmlspecialchars($p['descricao']) ?></td>
        <td>
            <a href="?param=produto/formularioalterar&id=<?= $p['id'] ?>" class="btn" style="background: #28a745;">Editar</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4" style="text-align: center; color: #666;">Nenhum produto cadastrado</td>
    </tr>
<?php endif; ?>
</table>
