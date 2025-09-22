<a href="/mvc20251/usuario/formulario">Novo Usuário</a>
<table>
    <tr><th>ID</th><th>Nome</th><th>Email</th></tr>
<?php foreach($parametro as $p){ ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nome'] ?></td>
        <td><?= $p['email'] ?></td>
    </tr>
<?php } ?>
</table>
