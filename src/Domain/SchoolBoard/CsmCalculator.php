<?php

namespace App\Domain\SchoolBoard;

use App\Domain\Student\Student;

/**
 * Class CsmCalculator
 *
 * @package App\Domain\SchoolBoard
 */
class CsmCalculator implements PassCalculatorInterface
{

    /**
     * @inheritDoc
     */
    public function pass(Student $student): bool
    {
        return $student->getAverageGrade() > 7;
    }
}