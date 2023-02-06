<?php

namespace App\Converter;

use App\Dto\LessonDTO;
use App\Entity\Lesson;

class LessonToLessonDTO
{

    /**
     * Converts Lesson object to LessonDTo object
     * @param Lesson $lesson
     * @return LessonDTO
     */
    public function convert(Lesson $lesson): LessonDTO
    {

        $lessonDTO = new LessonDTO();

        $lessonDTO->setId($lesson->getId());
        $lessonDTO->setName($lesson->getName());
        $lessonDTO->setDescription($lesson->getDescription());
        // todo add setTutor with converter
        // todo add setEnrolledStudents with converter

        return $lessonDTO;
    }


}