<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LessonRepository::class)
 */
class Lesson
{
    /**
     * @Groups({"admin", "lesson", "student_lesson"})
     * @ORM\Id
     * TODO REMOVE STRATEGY FOR REAL DATA
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"admin", "lesson", "student_lesson"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"admin", "lesson"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Groups("client", "student_lesson")
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lessons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tutor;

    /**
     * @Groups("none")  fixme enrolled admin as student?
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="lessonsEnrolled")
     */
    private $enrolledStudents;

    /**
     * @Groups({"lesson"})
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="lesson", orphanRemoval=true)
     */
    private $questions;

    public function __construct()
    {
        $this->enrolledStudents = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setLesson($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getLesson() === $this) {
                $question->setLesson(null);
            }
        }

        return $this;
    }
}
