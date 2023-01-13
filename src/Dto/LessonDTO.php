<?php

namespace App\Dto;

class LessonDTO
{

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var int $tutor
     */
    private $tutor;

    /**
     * @var array $enrolledStudents
     */
    private $enrolledStudents;

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param int $tutor
     * @param array $enrolledStudents
     */
    public function __construct(int $id, string $name, string $description, int $tutor, array $enrolledStudents)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->tutor = $tutor;
        $this->enrolledStudents = $enrolledStudents;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getTutor(): int
    {
        return $this->tutor;
    }

    /**
     * @param int $tutor
     */
    public function setTutor(int $tutor): void
    {
        $this->tutor = $tutor;
    }

    /**
     * @return array
     */
    public function getEnrolledStudents(): array
    {
        return $this->enrolledStudents;
    }

    /**
     * @param array $enrolledStudents
     */
    public function setEnrolledStudents(array $enrolledStudents): void
    {
        $this->enrolledStudents = $enrolledStudents;
    }
}