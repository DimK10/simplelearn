<?php

namespace App\Converter;

use App\Dto\LessonDTO;
use App\Entity\Lesson;

class LessonDTOToLesson
{

    /**
     * Converts LessonDTO to Lesson object
     * @param LessonDTO $lessonDTO
     * @return Lesson
     */
    public function convert(LessonDTO $lessonDTO): Lesson
    {

        $lesson = new Lesson();
        $lesson->setId($lessonDTO->getId());
        $lesson->setName($lessonDTO->getName());
        $lesson->setDescription($lessonDTO->getDescription());

        //todo add setTutor with converter
        //todo add setEnrolledStudents with converter

        return $lesson;
    }

}