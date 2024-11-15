<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/api/guest',
            normalizationContext: ['groups' => ['guest:read']]
        ),
        new Get(
            uriTemplate: '/api/guest/{id}',
            normalizationContext: ['groups' => ['guest:read']]
        ),
    ],
    normalizationContext: ['groups' => ['guest:read']],
    denormalizationContext: ['groups' => ['guest:write']]
)]
class Guest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?bool $Presence = null;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Event')]
    #[ORM\JoinColumn(name: 'event_id', referencedColumnName: 'id')]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return "Guest: " . $this->Name . ", Presence: " . ($this->Presence ? 'Yes' : 'No');
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;
        return $this;
    }

    public function getPresence(): ?bool
    {
        return $this->Presence;
    }

    public function setPresence(bool $Presence): self
    {
        $this->Presence = $Presence;
        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;
        return $this;
    }
}
