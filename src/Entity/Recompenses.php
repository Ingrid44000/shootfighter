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

    //imageFile enregistre le contenu du fichier mais ne stocke pas en base de données
    #[Vich\UploadableField(mapping: 'recompense_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    //imageName sert à stocker le nom en base de données
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 180)]
    private ?string $description = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;


    #[ORM\ManyToOne(inversedBy: 'recompenses')]
    private ?Tournois $tournois = null;

    #[ORM\OneToMany(mappedBy: 'recompenses', targetEntity: Participants::class)]
    private Collection $participants;

    public function __toString(): string
    {

        return $this->getNom();
    }

    public function __construct()
    {
        $this->participants = new ArrayCollection();
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

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTime();
        }

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


    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
            $participant->setRecompenses($this);
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getRecompenses() === $this) {
                $participant->setRecompenses(null);
            }
        }

        return $this;
    }

    public function getTournois(): ?Tournois
    {
        return $this->tournois;
    }

    public function setTournois(?Tournois $tournois): self
    {
        $this->tournois = $tournois;

        return $this;
    }

    public function addTournois(Tournois $tournois): self
    {
        if (!$this->tournois->contains($tournois)) {
            $this->tournois->add($tournois);
        }

        return $this;
    }

    public function removeTournois(Tournois $tournois): self
    {
        if ($this->tournois->contains($tournois)) {
            $this->tournois->removeElement($tournois);
    }
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

    public function setParticipants(?Participants $participants): self
    {
        // unset the owning side of the relation if necessary
        if ($participants === null && $this->participants !== null) {
            $this->participants->setRecompenses(null);
        }

        // set the owning side of the relation if necessary
        if ($participants !== null && $participants->getRecompenses() !== $this) {
            $participants->setRecompenses($this);
        }

        $this->participants = $participants;

        return $this;
    }
    public function getParticipants()
    {
        return $this->participants;
    }




}
