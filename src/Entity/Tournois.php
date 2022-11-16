<?php

namespace App\Entity;

use App\Repository\TournoisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: TournoisRepository::class)]
#[Vich\Uploadable]

class Tournois
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $nbPlacesMax = null;

    #[Vich\UploadableField(mapping: 'tournois_images', fileNameProperty:
        'imageName')]
    private ?File $imageFile = null;

    //imageName sert à stocker le nom en base de données
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable:true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLimiteInscription = null;

    #[Vich\UploadableField(mapping: 'recompense_images', fileNameProperty:
        'recompenses')]
    private ?File $imageFichier = null;


    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $recompense1= null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $recompense2= null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $recompense3= null;

    #[ORM\OneToMany(mappedBy: 'tournois', targetEntity: Recompenses::class)]
    private Collection $recompenses;

    #[ORM\OneToMany(mappedBy: 'tournois', targetEntity: Participants::class)]
    private Collection $participants;


    public function __construct()
    {

        $this->participants = new ArrayCollection();
        $this->recompenses = new ArrayCollection();

    }

    public function __toString(): string{

        return $this->getNom();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbPlacesMax(): ?int
    {
        return $this->nbPlacesMax;
    }

    public function setNbPlacesMax(int $nbPlacesMax): self
    {
        $this->nbPlacesMax = $nbPlacesMax;

        return $this;
    }


    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->addTournoi($this);
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            $participant->removeTournoi($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Recompenses>
     */
    public function getRecompenses(): Collection
    {
        return $this->recompenses;
    }
    public function setRecompenses(): Collection
    {
        return $this->recompenses;
    }
    public function addRecompense(Recompenses $recompense): self
    {
        if (!$this->recompenses->contains($recompense)) {
            $this->recompenses->add($recompense);
            $recompense->addTournois($this);
        }

        return $this;
    }

    public function removeRecompense(Recompenses $recompense): self
    {
        if ($this->recompenses->removeElement($recompense)) {
            $recompense->removeTournois($this);
        }

        return $this;
    }

    public function getDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(?\DateTimeInterface $dateLimiteInscription): self
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFichier
     */
    public function setImageFichier(?File $imageFichier = null): void
    {
        $this->imageFichier= $imageFichier;

    }

    public function getImageFichier(): ?File
    {
        return $this->imageFichier;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setParticipants(?Participants $participants): self
    {
        // unset the owning side of the relation if necessary
        if ($participants === null && $this->participants !== null) {
            $this->participants->setTournois(null);
        }

        // set the owning side of the relation if necessary
        if ($participants !== null && $participants->getTournois() !== $this) {
            $participants->setTournois($this);
        }

        $this->participants = $participants;

        return $this;
    }

    public function getParticipants(): ?Participants
    {
        return $this->participants;
    }

    public function getRecompense1(): ?string
    {
        return $this->recompense1;
    }

    public function setRecompense1(?string $recompense1): self
    {
        $this->recompense1 = $recompense1;

        return $this;
    }

    public function getRecompense2(): ?string
    {
        return $this->recompense2;
    }

    public function setRecompense2(?string $recompense2): self
    {
        $this->recompense2 = $recompense2;

        return $this;
    }

    public function getRecompense3(): ?string
    {
        return $this->recompense3;
    }

    public function setRecompense3(?string $recompense3): self
    {
        $this->recompense3 = $recompense3;

        return $this;
    }
}
