<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $currentlocation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthplace = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(targetEntity: Gender::class, inversedBy: 'candidate')]
    #[ORM\JoinColumn(name: 'gender_id', referencedColumnName: 'id', nullable: true)]
    private ?Gender $gender = null;

    #[ORM\OneToOne(targetEntity: JobCategory::class, inversedBy: 'candidate')]
    #[ORM\JoinColumn(name: 'job_category_id', referencedColumnName: 'id', nullable: true)]
    private ?JobCategory $jobCategory = null;

    #[ORM\OneToOne(targetEntity: Experience::class, inversedBy: 'candidate')]
    #[ORM\JoinColumn(name: 'experience_id', referencedColumnName: 'id', nullable: true)]
    private ?Experience $experience = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cv_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passport_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilepicture_path = null;


    #[ORM\OneToOne(inversedBy: 'candidate', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getCurrentlocation(): ?string
    {
        return $this->currentlocation;
    }

    public function setCurrentlocation(string $currentlocation): static
    {
        $this->currentlocation = $currentlocation;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): static
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    // Getter et setter pour jobCategory
    public function getJobCategory(): ?JobCategory
    {
        return $this->jobCategory;
    }

    public function setJobCategory(?JobCategory $jobCategory): self
    {
        $this->jobCategory = $jobCategory;
        return $this;
    }

    public function getExperience(): ?Experience
    {
        return $this->experience;
    }

    public function setExperience(?Experience $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCvPath(): ?string
    {
        return $this->cv_path;
    }

    public function setCvPath(string $cv_path): static
    {
        $this->cv_path = $cv_path;

        return $this;
    }

    public function getPassportPath(): ?string
    {
        return $this->passport_path;
    }

    public function setPassportPath(string $passport_path): static
    {
        $this->passport_path = $passport_path;

        return $this;
    }

    public function getProfilepicturePath(): ?string
    {
        return $this->profilepicture_path;
    }

    public function setProfilepicturePath(string $profilepicture_path): static
    {
        $this->profilepicture_path = $profilepicture_path;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
