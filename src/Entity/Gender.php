<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenderRepository::class)]
class Gender
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'gender', cascade: ['persist', 'remove'])]
    private ?Candidate $candidate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    
     // Getter et setter pour candidate
     public function getCandidate(): ?Candidate
     {
         return $this->candidate;
     }
 
     public function setCandidate(?Candidate $candidate): self
     {
         $this->candidate = $candidate;
         return $this;
     }
}
