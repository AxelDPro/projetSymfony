<?php

namespace App\Entity;

use App\Repository\ContactRepository;
<<<<<<< HEAD
=======
use Doctrine\DBAL\Types\Types;
>>>>>>> 86681f5292ae0840b83ce835b4bc73fe948ea242
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

<<<<<<< HEAD
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

=======
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 180, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $sujet = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;


    

>>>>>>> 86681f5292ae0840b83ce835b4bc73fe948ea242
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

<<<<<<< HEAD
    public function setNom(string $nom): static
=======
    public function setNom(?string $nom): static
>>>>>>> 86681f5292ae0840b83ce835b4bc73fe948ea242
    {
        $this->nom = $nom;

        return $this;
    }

<<<<<<< HEAD
    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;
=======
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

   

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(?string $sujet): static
    {
        $this->sujet = $sujet;
>>>>>>> 86681f5292ae0840b83ce835b4bc73fe948ea242

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

<<<<<<< HEAD
    public function setMessage(string $message): static
=======
    public function setMessage(?string $message): static
>>>>>>> 86681f5292ae0840b83ce835b4bc73fe948ea242
    {
        $this->message = $message;

        return $this;
    }
}
