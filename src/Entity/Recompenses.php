<?php

namespace App\Entity;

use App\Repository\RecompensesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: RecompensesRepository::class)]
#[Vich\Uploadable]

class Recompenses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $nom = null;

   #[Vich\UploadableField(mapping: 'recompense_images', fileNameProperty:
        'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(length: 180)]
    private ?string $description = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable:true)]
    private ?\DateTimeInterface $updatedAt = null;


    #[ORM\OneToMany(mappedBy: 'recompense', targetEntity: Participants::class)]
    private Collection $participants;

    #[ORM\ManyToMany(targetEntity: Tournois::class, inversedBy: 'recompenses')]
    private Collection $tournois;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->tournois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }


    /**
     * @return Collection<int, Participants>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setRecompense($this);
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getRecompense() === $this) {
                $participant->setRecompense(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tournois>
     */
    public function getTournois(): Collection
    {
        return $this->tournois;
    }

    public function addTournoi(Tournois $tournoi): self
    {
        if (!$this->tournois->contains($tournoi)) {
            $this->tournois->add($tournoi);
        }

        return $this;
    }

    public function removeTournoi(Tournois $tournoi): self
    {
        $this->tournois->removeElement($tournoi);

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }


    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
