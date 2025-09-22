<a href="/mvc20251/feedback/formulario">Enviar novo feedback</a>
<table>
    <tr><th>ID</th><th>Produto</th><th>Usuário</th><th>Nota</th><th>Comentário</th></tr>
<?php foreach($parametro as $p){ ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['produto'] ?></td>
        <td><?= $p['usuario'] ?></td>
        <td><?= $p['nota'] ?></td>
        <td><?= $p['comentario'] ?></td>
    </tr>
<?php } ?>
</table>
