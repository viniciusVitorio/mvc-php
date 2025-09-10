<?php include __DIR__ . '/../_layout/header.php'; ?>

<h2>Nova Pessoa</h2>

<form method="post" action="/people/store">
  <p><label>Nome<br><input name="name" required></label></p>
  <p><label>CPF<br><input name="cpf" required></label></p>
  
  <button>Salvar</button>
  <a class="button" href="/people">Cancelar</a>
</form>

<?php include __DIR__ . '/../_layout/footer.php'; ?>
