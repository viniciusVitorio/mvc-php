<?php include __DIR__ . '/../_layout/header.php'; ?>

<h2>Editar Pessoa</h2>

<form method="post" action="/people/update">
  
</form>

<form method="post" action="/people/update">
  <input type="hidden" name="id" value="<?= $person->id(); ?>">
  <p><label>Nome<br><input name="name" value="<?= htmlspecialchars($person->name()); ?>" required></label></p>
  <p><label>CPF<br><input name="cpf" value="<?= htmlspecialchars($person->cpf()); ?>" required></label></p>
  <button>Atualizar</button>
  <a class="button" href="/people">Cancelar</a>
</form>

<?php include __DIR__ . '/../_layout/footer.php'; ?>
