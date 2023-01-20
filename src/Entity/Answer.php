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
     * @Groups("lesson")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("lesson")
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @Groups("lesson")
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

    public function isCorrent(): ?bool
    {
        return $this->corrent;
    }

    public function setCorrent(bool $corrent): self
    {
        $this->corrent = $corrent;

        return $this;
    }

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
}
