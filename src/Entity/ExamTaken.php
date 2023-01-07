<?php

namespace App\Entity;

use App\Repository\ExamTakenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


enum ExamTakenType: string {
    case PRACTICE = 'PRACTICE';
    case OFFICIAL = 'OFFICIAL';
}


/**
 * @ORM\Entity(repositoryClass=ExamTakenRepository::class)
 */
class ExamTaken
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeStarted;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeEnded;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="examsTaken")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\ManyToMany(targetEntity=Answer::class, inversedBy="examsTakenThisAnswerWasCorrect")
     */
    private $correctAnswers;

    /**
     * @ORM\ManyToOne(targetEntity=Exam::class, inversedBy="tries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exam;

    /**
     * @ORM\Column(type="string", length=255, enumType=ExamTakenType::class)
     */
    private $type;

    public function __construct()
    {
        $this->correctAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
    public function getCorrectAnswers(): Collection
    {
        return $this->correctAnswers;
    }

    public function addCorrectAnswer(Answer $correctAnswer): self
    {
        if (!$this->correctAnswers->contains($correctAnswer)) {
            $this->correctAnswers[] = $correctAnswer;
        }

        return $this;
    }

    public function removeCorrectAnswer(Answer $correctAnswer): self
    {
        $this->correctAnswers->removeElement($correctAnswer);

        return $this;
    }

    public function getExam(): ?Exam
    {
        return $this->exam;
    }

    public function setExam(?Exam $exam): self
    {
        $this->exam = $exam;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
