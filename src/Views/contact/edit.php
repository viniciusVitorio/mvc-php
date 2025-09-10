<?php include __DIR__ . '/../_layout/header.php'; ?>

<h2>Editar Contato</h2>

<form method="post" action="/contacts/update">
  <input type="hidden" name="id" value="<?= $contact->id(); ?>">

  <p>
    <label>Tipo<br>
      <select name="type" required>
        <option value="phone" <?= $contact->type() === 'phone' ? 'selected' : '' ?>>Telefone</option>
        <option value="email" <?= $contact->type() === 'email' ? 'selected' : '' ?>>E-mail</option>
      </select>
    </label>
  </p>

  <p><label>Descrição<br><input name="description" value="<?= htmlspecialchars($contact->description()); ?>" required></label></p>

  <p>
    <label>Pessoa<br>
      <select name="person_id" required>
        <?php foreach ($allPeople as $people): ?>
          <option value="<?= $people->id(); ?>" <?= $contact->person()->id() === $people->id() ? 'selected' : '' ?>>
            <?= htmlspecialchars($people->name()); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
  </p>

  <button>Atualizar</button>
  <a class="button" href="/contacts">Cancelar</a>
</form>

<?php include __DIR__ . '/../_layout/footer.php'; ?>
