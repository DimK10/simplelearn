<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @Groups("user")
     * @ORM\Id
     * TODO REMOVE STRATEGY FOR REAL DATA
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("user")
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @Groups("user")
     * @ORM\Column(type="string", length=180)
     */
    private $username;

    /**
     * @Groups("user")
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Groups("user")
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Groups("user")
     * @ORM\OneToMany(targetEntity=Lesson::class, mappedBy="tutor", fetch="LAZY")
     * This represent the lessons this user is a teacher to
     */
    private $lessons;

    /**
     * @Groups("user")
     * @ORM\ManyToMany(targetEntity=Lesson::class, mappedBy="enrolledStudents")
     */
    private $lessonsEnrolled;

    /**
     * @Groups("user")
     * @ORM\OneToMany(targetEntity=ExamTaken::class, mappedBy="student")
     */
    private $examsTaken;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
        $this->lessonsEnrolled = new ArrayCollection();
        $this->examsTaken = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons[] = $lesson;
            $lesson->setTutor($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getTutor() === $this) {
                $lesson->setTutor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessonsEnrolled(): Collection
    {
        return $this->lessonsEnrolled;
    }

    public function addLessonsEnrolled(Lesson $lessonsEnrolled): self
    {
        if (!$this->lessonsEnrolled->contains($lessonsEnrolled)) {
            $this->lessonsEnrolled[] = $lessonsEnrolled;
            $lessonsEnrolled->addEnrolledStudent($this);
        }

        return $this;
    }

    public function removeLessonsEnrolled(Lesson $lessonsEnrolled): self
    {
        if ($this->lessonsEnrolled->removeElement($lessonsEnrolled)) {
            $lessonsEnrolled->removeEnrolledStudent($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ExamTaken>
     */
    public function getExamsTaken(): Collection
    {
        return $this->examsTaken;
    }

    public function addExamsTaken(ExamTaken $examsTaken): self
    {
        if (!$this->examsTaken->contains($examsTaken)) {
            $this->examsTaken[] = $examsTaken;
            $examsTaken->setStudent($this);
        }

        return $this;
    }

    public function removeExamsTaken(ExamTaken $examsTaken): self
    {
        if ($this->examsTaken->removeElement($examsTaken)) {
            // set the owning side to null (unless already changed)
            if ($examsTaken->getStudent() === $this) {
                $examsTaken->setStudent(null);
            }
        }

        return $this;
    }
}
