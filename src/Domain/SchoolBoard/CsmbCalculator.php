<?php

namespace App\Domain\SchoolBoard;

use App\Domain\Student\Student;

/**
 * Class CsmbCalculator
 *
 * @package App\Domain\SchoolBoard
 */
class CsmbCalculator implements PassCalculatorInterface
{

    /**
     * @inheritDoc
     */
    public function pass(Student $student): bool
    {
        $studentGrades = $student->getGrades();

        return count($studentGrades) > 2 && max($student->getGrades()) > 8;
    }
}