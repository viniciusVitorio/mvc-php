<?php include __DIR__ . '/../_layout/header.php'; ?>

<h2>Novo Contato</h2>

<form method="post" action="/contacts/store">
  <p>
    <label>Tipo<br>
      <select name="type" required>
        <option value="">-- Selecione --</option>
        <option value="phone">Telefone</option>
        <option value="email">E-mail</option>
      </select>
    </label>
  </p>

  <p><label>Descrição<br><input name="description" required></label></p>

  <p>
    <label>Pessoa<br>
      <select name="person_id" required>
        <option value="">-- Selecione --</option>
        <?php foreach ($allPeople as $p): ?>
          <option value="<?= $p->id(); ?>" <?= $currentPerson && $currentPerson->id() === $p->id() ? 'selected' : '' ?>>
            <?= htmlspecialchars($p->name()); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
  </p>

  <button>Salvar</button>
  <a class="button" href="/contacts">Cancelar</a>
</form>

<?php include __DIR__ . '/../_layout/footer.php'; ?>
