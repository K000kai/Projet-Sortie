<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25, unique: true)]
    private ?string $Username = null;

    #[ORM\Column(length: 40)]
    private ?string $Name = null;

    #[ORM\Column(length: 40)]
    private ?string $Surname = null;

    #[ORM\Column]
    private ?int $Phone = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $Campus = null;

    #[ORM\Column(length:255, nullable: true)]
    private ?string $Picture = null;

    #[ORM\OneToOne(mappedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): static
    {
        $this->Username = $Username;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): static
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->Phone;
    }

    public function setPhone(int $Phone): static
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getCampus(): ?string
    {
        return $this->Campus;
    }

    public function setCampus(string $Campus): static
    {
        $this->Campus = $Campus;

        return $this;
    }

    public function getPicture(): string
    {
        return $this->Picture;
    }

    public function setPicture($Picture): static
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getProfile() !== $this) {
            $user->setProfile($this);
        }

        $this->user = $user;

        return $this;
    }
}
