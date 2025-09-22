<a href="/mvc20251/produto/formulario">Novo Produto</a>
<table>
    <tr><th>ID</th><th>Nome</th><th>Descrição</th></tr>
<?php foreach($parametro as $p){ ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nome'] ?></td>
        <td><?= $p['descricao'] ?></td>
    </tr>
<?php } ?>
</table>
