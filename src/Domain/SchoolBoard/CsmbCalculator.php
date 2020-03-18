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
        $pass = $student->getAverageGrade() > 7;

        if ($pass && count($student->getGrades()) > 2)
        {
            $max = max($student->getGrades());

            return $max >= 8;
        }

        return $pass;
    }
}