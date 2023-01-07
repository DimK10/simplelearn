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
     * @ORM\ManyToMany(targetEntity=Question::class, inversedBy="examsAsPossibleQuestion")
     * @JoinTable(name="exam_question",
     *      joinColumns={@JoinColumn(name="exam_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="question_id", referencedColumnName="id")}
     *      )
     */
    private $questions;

    /**
     * @ORM\ManyToMany(targetEntity=Question::class, inversedBy="examsAsSelectedQuestion")
     * @JoinTable(name="exam_question_selected",
     *      joinColumns={@JoinColumn(name="exam_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="question_id", referencedColumnName="id")}
     *      )
     */
    private $questionsSelected;

    /**
     * @ORM\OneToMany(targetEntity=ExamTaken::class, mappedBy="exam")
     */
    private $tries;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->questionsSelected = new ArrayCollection();
        $this->tries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        $this->questions->removeElement($question);

        return $this;
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

    /**
     * @return Collection<int, ExamTaken>
     */
    public function getTries(): Collection
    {
        return $this->tries;
    }

    public function addTry(ExamTaken $try): self
    {
        if (!$this->tries->contains($try)) {
            $this->tries[] = $try;
            $try->setExam($this);
        }

        return $this;
    }

    public function removeTry(ExamTaken $try): self
    {
        if ($this->tries->removeElement($try)) {
            // set the owning side to null (unless already changed)
            if ($try->getExam() === $this) {
                $try->setExam(null);
            }
        }

        return $this;
    }
}
