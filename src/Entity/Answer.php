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
     * @Groups({"lesson", "answer"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"lesson", "answer"})
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @Groups({"lesson", "answer"})
     * @ORM\Column(type="boolean")
     */
    private $correct;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToMany(targetEntity=ExamTaken::class, mappedBy="correctAnswers")
     */
    private $examsTakenThisAnswerWasCorrect;

    /**
     * @Groups({"lesson", "answer"})
     * @ORM\Column(type="integer")
     */
    private $rowNum;

    /**
     * @Groups({"lesson", "answer"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function __construct()
    {
        $this->examsTakenThisAnswerWasCorrect = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, ExamTaken>
     */
    public function getExamsTakenThisAnswerWasCorrect(): Collection
    {
        return $this->examsTakenThisAnswerWasCorrect;
    }

    public function addExamsTakenThisAnswerWasCorrect(ExamTaken $examsTakenThisAnswerWasCorrect): self
    {
        if (!$this->examsTakenThisAnswerWasCorrect->contains($examsTakenThisAnswerWasCorrect)) {
            $this->examsTakenThisAnswerWasCorrect[] = $examsTakenThisAnswerWasCorrect;
            $examsTakenThisAnswerWasCorrect->addCorrectAnswer($this);
        }

        return $this;
    }

    public function removeExamsTakenThisAnswerWasCorrect(ExamTaken $examsTakenThisAnswerWasCorrect): self
    {
        if ($this->examsTakenThisAnswerWasCorrect->removeElement($examsTakenThisAnswerWasCorrect)) {
            $examsTakenThisAnswerWasCorrect->removeCorrectAnswer($this);
        }

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
}
