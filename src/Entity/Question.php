<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

enum QuestionType: string {
    case EASY = 'EASY';
    case MODERATE = 'MODERATE';
    case HARD = 'HARD';
}

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * TODO REMOVE STRATEGY FOR REAL DATA
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, enumType=QuestionType::class)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="question", orphanRemoval=true)
     */
    private $answers;

    /**
     * @ORM\ManyToMany(targetEntity=Exam::class, mappedBy="questions")
     */
    private $examsAsPossibleQuestion;

    /**
     * @ORM\ManyToMany(targetEntity=Exam::class, mappedBy="questionsSelected")
     */
    private $examsAsSelectedQuestion;

    /**
     * @ORM\ManyToOne(targetEntity=Lesson::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lesson;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->examsAsPossibleQuestion = new ArrayCollection();
        $this->examsAsSelectedQuestion = new ArrayCollection();
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


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exam>
     */
    public function getExamsAsPossibleQuestion(): Collection
    {
        return $this->examsAsPossibleQuestion;
    }

    public function addExamsAsPossibleQuestion(Exam $examsAsPossibleQuestion): self
    {
        if (!$this->examsAsPossibleQuestion->contains($examsAsPossibleQuestion)) {
            $this->examsAsPossibleQuestion[] = $examsAsPossibleQuestion;
            $examsAsPossibleQuestion->addQuestion($this);
        }

        return $this;
    }

    public function removeExamsAsPossibleQuestion(Exam $examsAsPossibleQuestion): self
    {
        if ($this->examsAsPossibleQuestion->removeElement($examsAsPossibleQuestion)) {
            $examsAsPossibleQuestion->removeQuestion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Exam>
     */
    public function getExamsAsSelectedQuestion(): Collection
    {
        return $this->examsAsSelectedQuestion;
    }

    public function addExamsAsSelectedQuestion(Exam $examsAsSelectedQuestion): self
    {
        if (!$this->examsAsSelectedQuestion->contains($examsAsSelectedQuestion)) {
            $this->examsAsSelectedQuestion[] = $examsAsSelectedQuestion;
            $examsAsSelectedQuestion->addQuestionsSelected($this);
        }

        return $this;
    }

    public function removeExamsAsSelectedQuestion(Exam $examsAsSelectedQuestion): self
    {
        if ($this->examsAsSelectedQuestion->removeElement($examsAsSelectedQuestion)) {
            $examsAsSelectedQuestion->removeQuestionsSelected($this);
        }

        return $this;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): self
    {
        $this->lesson = $lesson;

        return $this;
    }
}
