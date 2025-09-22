<a href="/mvc20251/feedback/lista">Voltar</a>
<form method="POST" action="/mvc20251/feedback/inserir">
    <label>Produto:</label>
    <select name="produto">
        <?php foreach($parametro['produtos'] as $prod){ ?>
            <option value="<?= $prod['id'] ?>"><?= $prod['nome'] ?></option>
        <?php } ?>
    </select>
    <br/>
    <label>Usuário:</label>
    <select name="usuario">
        <?php foreach($parametro['usuarios'] as $u){ ?>
            <option value="<?= $u['id'] ?>"><?= $u['nome'] ?></option>
        <?php } ?>
    </select>
    <br/>
    <label>Nota (0-5):</label>
    <input type="number" name="nota" min="0" max="5" />
    <br/>
    <label>Comentário:</label>
    <textarea name="comentario"></textarea>
    <br/>
    <input type="submit" value="Enviar Feedback" />
</form>
