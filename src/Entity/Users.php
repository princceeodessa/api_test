<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\Repository\UsersRepository;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/api/users',
            normalizationContext: ['groups' => ['users:read']]
        ),
        new Get(
            uriTemplate: '/api/users/{id}',
            normalizationContext: ['groups' => ['users:read']]
        ),
    ],
    normalizationContext: ['groups' => ['users:read']],
    denormalizationContext: ['groups' => ['users:write']]
)]
class Users implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->username ?? '';
    }

    public function eraseCredentials(): void
    {
    }
}
