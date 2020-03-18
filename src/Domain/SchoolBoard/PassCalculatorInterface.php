<?php


namespace App\Domain\SchoolBoard;

use App\Domain\Student\Student;

/**
 * Interface PassCalculatorInterface
 *
 * @package App\Domain\SchoolBoard
 */
interface PassCalculatorInterface
{

    /**
     * @param  Student $student
     *
     * @return bool
     */
    public function pass(Student $student): bool;
}