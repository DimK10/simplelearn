<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 */
class Answer
{
    /**
     * @Groups({"lesson", "answer", "exam"})
     * @ORM\Id
     * TODO REMOVE STRATEGY FOR REAL DATA
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"lesson", "answer", "exam"})
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @Groups({"lesson", "answer", "exam"})
     * @ORM\Column(type="boolean")
     */
    private $correct;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @Groups({"lesson", "answer", "exam"})
     * @ORM\Column(type="integer")
     */
    private $rowNum;

    /**
     * @Groups({"lesson", "answer", "exam"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Exam::class, mappedBy="answersGivenByStudent")
     */
    private $exams;

    public function __construct()
    {
        $this->examsTakenThisAnswerWasCorrect = new ArrayCollection();
        $this->exams = new ArrayCollection();
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * @param mixed $correct
     */
    public function setCorrect($correct): void
    {
        $this->correct = $correct;
    }
//
//    public function isCorrent(): ?bool
//    {
//        return $this->corrent;
//    }
//
//    public function setCorrent(bool $corrent): self
//    {
//        $this->corrent = $corrent;
//
//        return $this;
//    }


    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Exam>
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    public function addExam(Exam $exam): self
    {
        if (!$this->exams->contains($exam)) {
            $this->exams[] = $exam;
            $exam->addAnswersGivenByStudent($this);
        }

        return $this;
    }

    public function removeExam(Exam $exam): self
    {
        if ($this->exams->removeElement($exam)) {
            $exam->removeAnswersGivenByStudent($this);
        }

        return $this;
    }
}
