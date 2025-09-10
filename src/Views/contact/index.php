<?php include __DIR__ . '/../_layout/header.php'; ?>

<h2>Contatos</h2>

<form method="get" action="/contacts">
  <label>
    Pessoa:
    <select name="person_id" onchange="this.form.submit()">
      <option value="0">-- Todas --</option>
      <?php foreach ($allPeople as $p): ?>
        <option value="<?= $p->id(); ?>" <?= $currentPerson && $currentPerson->id() === $p->id() ? 'selected' : '' ?>>
          <?= htmlspecialchars($p->name()); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
  <a class="button" href="/contacts/create<?= $currentPerson ? '?person_id=' . $currentPerson->id() : '' ?>">Novo contato</a>
</form>

<br>

<table>
  <tr>
    <th>ID</th>
    <th>Tipo</th>
    <th>Descrição</th>
    <th>Pessoa</th>
    <th>Ações</th>
  </tr>
  <?php foreach ($contacts as $c): ?>
    <tr>
      <td><?= $c->id(); ?></td>
      <td><?= htmlspecialchars($c->type()); ?></td>
      <td><?= htmlspecialchars($c->description()); ?></td>
      <td><?= htmlspecialchars($c->person()->name()); ?></td>
      <td>
        <a class="button" href="/contacts/edit?id=<?= $c->id(); ?>">Editar</a>
        <form class="inline" method="post" action="/contacts/delete" onsubmit="return confirm('Excluir este contato?')">
          <input type="hidden" name="id" value="<?= $c->id(); ?>">
          <button>Excluir</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../_layout/footer.php'; ?>
