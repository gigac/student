<?php

namespace App\Domain\Student;

use Exception;
use App\Domain\SchoolBoard\Type as SchoolBoard;
use App\Statistics\Student\Concerns\CalculatorResolver;

/**
 * Class Student
 *
 * @package App\Domain
 */
class Student
{

    use CalculatorResolver;

    /**
     * @var int
     */
    private $studentId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var SchoolBoard
     */
    private $schoolBoard;

    /**
     * @var array
     */
    private $grades = [];

    /**
     * Student constructor.
     *
     * @param  string      $studentId
     * @param  string      $name
     * @param  SchoolBoard $schoolBoard
     * @param  array       $grades
     *
     * @throws Exception
     */
    private function __construct(string $studentId, string $name, SchoolBoard $schoolBoard, $grades = [])
    {
        $this->studentId = $studentId;
        $this->name = $name;
        $this->schoolBoard = $schoolBoard;
        $this->grades = $grades;

        $this->guardAgainstGradeCountLimit();
        $this->resolveCalculator($schoolBoard);
    }

    /**
     * @throws Exception
     */
    private function guardAgainstGradeCountLimit()
    {
        if (count($this->grades) > 4)
        {
            throw new Exception('Maximum number of grades per student is 4');
        }

        if (empty($this->grades))
        {
            throw new Exception('A student must have at least one grade');
        }
    }

    /**
     * Make new student
     *
     * @param  int         $studentId
     * @param  string      $name
     * @param  SchoolBoard $schoolBoard
     * @param  array       $grades
     *
     * @return Student
     *
     * @throws Exception
     */
    public static function make(int $studentId, string $name, SchoolBoard $schoolBoard, $grades = []): Student
    {
        return new static($studentId, $name, $schoolBoard, $grades);
    }

    /**
     * @return int
     */
    public function getStudentId(): int
    {
        return $this->studentId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return SchoolBoard
     */
    public function getSchoolBoard(): SchoolBoard
    {
        return $this->schoolBoard;
    }

    /**
     * @return array
     */
    public function getGrades(): array
    {
        return $this->grades;
    }

    /**
     * @return float
     */
    public function getAverageGrade(): float
    {
        $sum = array_sum($this->getGrades());
        $average = $sum / count($this->getGrades());

        return round(
            $average,
            2
        );
    }

    /**
     * @return bool
     */
    public function passed()
    {
        return $this->calculator->pass($this);
    }
}