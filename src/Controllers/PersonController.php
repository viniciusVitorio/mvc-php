<?php

namespace src\Controllers;

use src\Infra\EntityManagerFactory;
use src\Domain\Entity\Person;
use src\Support\Response;

class PersonController
{
    public function index(): void
    {
        $entityManager = EntityManagerFactory::create();
        $repo      = $entityManager->getRepository(Person::class);
        $search    = trim($_GET['q'] ?? '');

        $people = $search !== ''
            ? array_filter(
                $repo->findBy([], ['id' => 'DESC']),
                fn(Person $person): bool => stripos($person->name(), $search) !== false
            )
            : $repo->findBy([], ['id' => 'DESC']);

        include __DIR__ . '/../Views/person/index.php';
    }

    public function create(): void
    {
        include __DIR__ . '/../Views/person/create.php';
    }

    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $cpf  = trim($_POST['cpf'] ?? '');

        $errors = [];
        if ($name === '') $errors[] = 'Nome é obrigatório.';
        if ($cpf === '')  $errors[] = 'CPF é obrigatório.';

        if ($errors) {
            Response::json(['errors' => $errors], 422);
            return;
        }

        $entityManager = EntityManagerFactory::create();
        $person = new Person($name, $cpf);

        $entityManager->persist($person);
        $entityManager->flush();

        Response::redirect('/people');
    }

    public function edit(): void
    {
        $id   = (int)($_GET['id'] ?? 0);
        $entityManager   = EntityManagerFactory::create();
        $person = $entityManager->find(Person::class, $id);

        if (!$person) {
            Response::json(['error' => 'Pessoa não encontrada.'], 404);
            return;
        }

        include __DIR__ . '/../Views/person/edit.php';
    }

    public function update(): void
    {
        $id   = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $cpf  = trim($_POST['cpf'] ?? '');

        $entityManager     = EntityManagerFactory::create();
        $person = $entityManager->find(Person::class, $id);

        if (!$person) {
            Response::json(['error' => 'Pessoa não encontrada.'], 404);
            return;
        }

        $errors = [];
        if ($name === '') $errors[] = 'Nome é obrigatório.';
        if ($cpf === '')  $errors[] = 'CPF é obrigatório.';

        if ($errors) {
            Response::json(['errors' => $errors], 422);
            return;
        }

        $person->setName($name);
        $person->setCpf($cpf);
        $entityManager->flush();

        Response::redirect('/people');
    }

    public function destroy(): void
    {
        $id     = (int)($_POST['id'] ?? 0);
        $entityManager     = EntityManagerFactory::create();
        $person = $entityManager->find(Person::class, $id);

        if (!$person) {
            Response::json(['error' => 'Pessoa não encontrada.'], 404);
            return;
        }

        $entityManager->rentityManagerove($person);
        $entityManager->flush();

        Response::redirect('/people');
    }
}
