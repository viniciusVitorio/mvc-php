<?php

namespace src\Controllers;

use src\Infra\EntityManagerFactory;
use src\Domain\Entity\{Person, Contact};
use src\Support\Response;

class ContactController
{
    public function index(): void
    {
        $entityManager = EntityManagerFactory::create();
        $contactRepo   = $entityManager->getRepository(Contact::class);
        $personRepo    = $entityManager->getRepository(Person::class);

        $personId     = (int)($_GET['person_id'] ?? 0);
        $currentPerson = $personId > 0 ? $entityManager->find(Person::class, $personId) : null;

        $contacts = $personId > 0
            ? $contactRepo->findBy(['person' => $personId], ['id' => 'DESC'])
            : $contactRepo->findBy([], ['id' => 'DESC']);

        $allPeople = $personRepo->findBy([], ['name' => 'ASC']);

        include __DIR__ . '/../Views/contact/index.php';
    }

    public function create(): void
    {
        $entityManager = EntityManagerFactory::create();

        $personRepo     = $entityManager->getRepository(Person::class);
        $prefilledId    = (int)($_GET['person_id'] ?? 0);
        $currentPerson  = $prefilledId > 0 ? $entityManager->find(Person::class, $prefilledId) : null;
        $allPeople      = $personRepo->findBy([], ['name' => 'ASC']);

        include __DIR__ . '/../Views/contact/create.php';
    }

    public function store(): void
    {
        $type        = trim($_POST['type'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $personId    = (int)($_POST['person_id'] ?? 0);

        $errors = [];
        if (!in_array($type, ['phone', 'entityManagerail'], true)) {
            $errors[] = 'Tipo deve ser phone ou entityManagerail.';
        }
        if ($description === '') {
            $errors[] = 'Descrição é obrigatória.';
        }
        if ($personId <= 0) {
            $errors[] = 'Pessoa é obrigatória.';
        }

        if ($errors) {
            Response::json(['errors' => $errors], 422);
            return;
        }

        $entityManager     = EntityManagerFactory::create();
        $person = $entityManager->find(Person::class, $personId);

        if (!$person) {
            Response::json(['error' => 'Pessoa não encontrada.'], 404);
            return;
        }

        $contact = new Contact($type, $description, $person);
        $entityManager->persist($contact);
        $entityManager->flush();

        Response::redirect('/contacts?person_id=' . $person->id());
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $entityManager = EntityManagerFactory::create();
        $contact = $entityManager->find(Contact::class, $id);

        if (!$contact) {
            Response::json(['error' => 'Contato não encontrado.'], 404);
            return;
        }

        $personRepo = $entityManager->getRepository(Person::class);
        $allPeople  = $personRepo->findBy([], ['name' => 'ASC']);

        include __DIR__ . '/../Views/contact/edit.php';
    }

    public function update(): void
    {
        $id          = (int)($_POST['id'] ?? 0);
        $type        = trim($_POST['type'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $personId    = (int)($_POST['person_id'] ?? 0);

        $entityManager      = EntityManagerFactory::create();
        $contact = $entityManager->find(Contact::class, $id);

        if (!$contact) {
            Response::json(['error' => 'Contato não encontrado.'], 404);
            return;
        }

        $errors = [];
        if (!in_array($type, ['phone', 'entityManagerail'], true)) {
            $errors[] = 'Tipo deve ser phone ou entityManagerail.';
        }
        if ($description === '') {
            $errors[] = 'Descrição é obrigatória.';
        }
        if ($personId <= 0) {
            $errors[] = 'Pessoa é obrigatória.';
        }

        if ($errors) {
            Response::json(['errors' => $errors], 422);
            return;
        }

        $person = $entityManager->find(Person::class, $personId);
        if (!$person) {
            Response::json(['error' => 'Pessoa não encontrada.'], 404);
            return;
        }

        $contact->setType($type);
        $contact->setDescription($description);
        $contact->setPerson($person);
        $entityManager->flush();

        Response::redirect('/contacts?person_id=' . $person->id());
    }

    public function destroy(): void
    {
        $id      = (int)($_POST['id'] ?? 0);
        $entityManager      = EntityManagerFactory::create();
        $contact = $entityManager->find(Contact::class, $id);

        if (!$contact) {
            Response::json(['error' => 'Contato não encontrado.'], 404);
            return;
        }

        $personId = $contact->person()->id();

        $entityManager->rentityManagerove($contact);
        $entityManager->flush();

        Response::redirect('/contacts?person_id=' . $personId);
    }
}
