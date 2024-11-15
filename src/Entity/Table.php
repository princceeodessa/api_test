<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TableRepository;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: "tables")]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/api/table',
            normalizationContext: ['groups' => ['table:read']]
        ),
        new Get(
            uriTemplate: '/api/table/{id}',
            normalizationContext: ['groups' => ['table:read']]
        ),
    ],
    normalizationContext: ['groups' => ['table:read']],
    denormalizationContext: ['groups' => ['table:write']]
)]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tableNumber = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $maxCapacity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTableNumber(): ?string
    {
        return $this->tableNumber;
    }

    public function setTableNumber(string $tableNumber): static
    {
        $this->tableNumber = $tableNumber;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getMaxCapacity(): ?int
    {
        return $this->maxCapacity;
    }

    public function setMaxCapacity(int $maxCapacity): static
    {
        $this->maxCapacity = $maxCapacity;
        return $this;
    }
}
