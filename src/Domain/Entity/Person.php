<?php
namespace src\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "persons")]
class Person {
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:120)]
    private string $name;

    #[ORM\Column(type:"string", length:14, unique:true)]
    private string $cpf;

    /** @var Collection<int, Contact> */
    #[ORM\OneToMany(mappedBy:"person", targetEntity: Contact::class, cascade:["persist","remove"], orphanRemoval:true)]
    private Collection $contacts;

    public function __construct(string $name, string $cpf) {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->contacts = new ArrayCollection();
    }

    public function id(): ?int { return $this->id; }
    public function name(): string { return $this->name; }
    public function cpf(): string { return $this->cpf; }

    public function setName(string $n): void { $this->name = $n; }
    public function setCpf(string $c): void { $this->cpf = $c; }
}
