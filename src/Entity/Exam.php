<?php

namespace App\Entity;

use App\Repository\ExamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;


/**
 * @ORM\Entity(repositoryClass=ExamRepository::class)
 */
class Exam
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Question::class, inversedBy="examsAsSelectedQuestion")
     * @JoinTable(name="exam_question_selected",
     *      joinColumns={@JoinColumn(name="exam_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="question_id", referencedColumnName="id")}
     *      )
     */
    private $questionsSelected;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeStarted;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeEnded;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\ManyToMany(targetEntity=Answer::class, inversedBy="exams")
     */
    private $answersGivenByStudent;

    public function __construct()
    {
        $this->questionsSelected = new ArrayCollection();
        $this->answersGivenByStudent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestionsSelected(): Collection
    {
        return $this->questionsSelected;
    }

    public function addQuestionsSelected(Question $questionsSelected): self
    {
        if (!$this->questionsSelected->contains($questionsSelected)) {
            $this->questionsSelected[] = $questionsSelected;
        }

        return $this;
    }

    public function removeQuestionsSelected(Question $questionsSelected): self
    {
        $this->questionsSelected->removeElement($questionsSelected);

        return $this;
    }

    public function getTimeStarted(): ?\DateTimeInterface
    {
        return $this->timeStarted;
    }

    public function setTimeStarted(\DateTimeInterface $timeStarted): self
    {
        $this->timeStarted = $timeStarted;

        return $this;
    }

    public function getTimeEnded(): ?\DateTimeInterface
    {
        return $this->timeEnded;
    }

    public function setTimeEnded(\DateTimeInterface $timeEnded): self
    {
        $this->timeEnded = $timeEnded;

        return $this;
    }

    public function getStudent(): ?User
    {
        return $this->student;
    }

    public function setStudent(?User $student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswersGivenByStudent(): Collection
    {
        return $this->answersGivenByStudent;
    }

    public function addAnswersGivenByStudent(Answer $answersGivenByStudent): self
    {
        if (!$this->answersGivenByStudent->contains($answersGivenByStudent)) {
            $this->answersGivenByStudent[] = $answersGivenByStudent;
        }

        return $this;
    }

    public function removeAnswersGivenByStudent(Answer $answersGivenByStudent): self
    {
        $this->answersGivenByStudent->removeElement($answersGivenByStudent);

        return $this;
    }
}
