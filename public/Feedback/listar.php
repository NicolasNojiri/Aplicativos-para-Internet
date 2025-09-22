<h2>Lista de Feedbacks</h2>
<a href="?param=feedback/formulario" class="btn">Enviar novo feedback</a>
<table>
    <tr><th>ID</th><th>Produto</th><th>Usuário</th><th>Nota</th><th>Comentário</th></tr>
<?php if($parametro && count($parametro) > 0): ?>
    <?php foreach($parametro as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id']) ?></td>
        <td><?= htmlspecialchars($p['produto']) ?></td>
        <td><?= htmlspecialchars($p['usuario']) ?></td>
        <td>
            <span style="background: <?= $p['nota'] >= 4 ? '#28a745' : ($p['nota'] >= 3 ? '#ffc107' : '#dc3545') ?>; color: white; padding: 2px 8px; border-radius: 3px;">
                <?= htmlspecialchars($p['nota']) ?>/5
            </span>
        </td>
        <td><?= htmlspecialchars($p['comentario']) ?></td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" style="text-align: center; color: #666;">Nenhum feedback cadastrado</td>
    </tr>
<?php endif; ?>
</table>
