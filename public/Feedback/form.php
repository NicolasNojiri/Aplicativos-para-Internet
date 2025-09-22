<h2>Enviar Feedback</h2>
<a href="?param=feedback/lista" class="btn" style="background: #6c757d;">Voltar</a>
<form method="POST" action="?param=feedback/inserir">
    <div class="form-group">
        <label for="produto">Produto:</label>
        <select id="produto" name="produto" required>
            <option value="">Selecione um produto...</option>
            <?php if(isset($parametro['produtos']) && count($parametro['produtos']) > 0): ?>
                <?php foreach($parametro['produtos'] as $prod): ?>
                    <option value="<?= htmlspecialchars($prod['id']) ?>"><?= htmlspecialchars($prod['nome']) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="usuario">Usuário:</label>
        <select id="usuario" name="usuario" required>
            <option value="">Selecione um usuário...</option>
            <?php if(isset($parametro['usuarios']) && count($parametro['usuarios']) > 0): ?>
                <?php foreach($parametro['usuarios'] as $u): ?>
                    <option value="<?= htmlspecialchars($u['id']) ?>"><?= htmlspecialchars($u['nome']) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="nota">Nota (0-5):</label>
        <input type="number" id="nota" name="nota" min="0" max="5" step="1" required />
    </div>
    <div class="form-group">
        <label for="comentario">Comentário:</label>
        <textarea id="comentario" name="comentario" placeholder="Descreva sua experiência..." required></textarea>
    </div>
    <input type="submit" value="Enviar Feedback" class="btn" />
</form>
