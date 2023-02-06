<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @Groups({"lesson", "exam"})
     * @ORM\Id
     * TODO REMOVE STRATEGY FOR REAL DATA
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"lesson", "exam"})
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @Groups({"lesson", "exam"})
     * @ORM\Column(type="string", length=255)
     */
    private $difficulty;

    /**
     * @Groups({"lesson", "exam"})
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

    /**
     * @Groups({"lesson", "exam"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @Groups({"lesson", "exam"})
     * @ORM\Column(type="integer")
     */
    private $rowNum;

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

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $difficulty
     */
    public function setDifficulty($difficulty): void
    {
        $this->difficulty = $difficulty;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRowNum(): ?int
    {
        return $this->rowNum;
    }

    public function setRowNum(int $rowNum): self
    {
        $this->rowNum = $rowNum;

        return $this;
    }
}
