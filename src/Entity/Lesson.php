<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LessonRepository::class)
 */
class Lesson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lessons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tutor;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="lessonsEnrolled")
     */
    private $enrolledStudents;

    public function __construct()
    {
        $this->enrolledStudents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTutor(): ?User
    {
        return $this->tutor;
    }

    public function setTutor(?User $tutor): self
    {
        $this->tutor = $tutor;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getEnrolledStudents(): Collection
    {
        return $this->enrolledStudents;
    }

    public function addEnrolledStudent(User $enrolledStudent): self
    {
        if (!$this->enrolledStudents->contains($enrolledStudent)) {
            $this->enrolledStudents[] = $enrolledStudent;
        }

        return $this;
    }

    public function removeEnrolledStudent(User $enrolledStudent): self
    {
        $this->enrolledStudents->removeElement($enrolledStudent);

        return $this;
    }
}
