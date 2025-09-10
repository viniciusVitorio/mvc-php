<?php include __DIR__ . '/../_layout/header.php'; ?>

<h2>Pessoas</h2>

<form method="get" action="/people">
  <input type="text" name="q" placeholder="Buscar por nome" value="<?= htmlspecialchars($q ?? '') ?>">
  <button>Pesquisar</button>
  <a class="button" href="/people/create">Nova pessoa</a>
</form>

<br>

<table>
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>CPF</th>
    <th>Ações</th>
  </tr>
  <?php foreach ($peopleeople as $people): ?>
    <tr>
      <td><?= $people->id(); ?></td>
      <td><?= htmlspecialchars($people->name()); ?></td>
      <td><?= htmlspecialchars($people->cpf()); ?></td>
      <td>
        <a class="button" href="/people/edit?id=<?= $people->id(); ?>">Editar</a>
        <form class="inline" method="post" action="/people/delete" onsubmit="return confirm('Excluir esta pessoa?')">
          <input type="hidden" name="id" value="<?= $people->id(); ?>">
          <button>Excluir</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../_layout/footer.php'; ?>
