<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TableRepository;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ApiResource]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $table_number = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $max_capacity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTableNumber(): ?string
    {
        return $this->table_number;
    }

    public function setTableNumber(string $table_number): static
    {
        $this->table_number = $table_number;
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
        return $this->max_capacity;
    }

    public function setMaxCapacity(int $max_capacity): static
    {
        $this->max_capacity = $max_capacity;
        return $this;
    }
}
