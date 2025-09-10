<?php
namespace src\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "contacts")]
class Contact
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 20)]
    private string $type; 

    #[ORM\Column(type: "string", length: 180)]
    private string $description;

    #[ORM\ManyToOne(targetEntity: Person::class, inversedBy: "contacts")]
    #[ORM\JoinColumn(name: "person_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private Person $person;

    public function __construct(string $type, string $description, Person $person) {
        $this->type = $type;
        $this->description = $description;
        $this->person = $person;
    }

    public function id(): ?int { 
        return $this->id; 
    }

    public function type(): string { 
        return $this->type; 
    }

    public function description(): string {
        return $this->description; 
    }

    public function person(): Person {
        return $this->person; 
    }

    public function setType(string $type): void { 
        $this->type = $type; 
    }

    public function setDescription(string $description): void {
        $this->description = $description; 
    }

    public function setPerson(Person $person): void { 
        $this->person = $person; 
    }
}
