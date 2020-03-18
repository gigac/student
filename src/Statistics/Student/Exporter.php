<?php

namespace App\Statistics\Student;

use App\Domain\Student\Student;

/**
 * Class Generator
 *
 * @package App\Statistics\Student
 */
abstract class Exporter
{

    /**
     * @var Student
     */
    private $student;

    /**
     * Export data
     *
     * @return string
     */
    abstract public function export();

    /**
     * Exporter constructor.
     *
     * @param  Student $student
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id'           => $this->student->getStudentId(),
            'name'         => $this->student->getName(),
            'grades'       => $this->student->getGrades(),
            'average'      => $this->student->getAverageGrade(),
            'final_result' => $this->student->passed() ? 'Pass' : 'Fail'
        ];
    }

    /**
     * @return Student
     */
    protected function getStudent(): Student
    {
        return $this->student;
    }
}