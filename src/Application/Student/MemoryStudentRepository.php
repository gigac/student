<?php

namespace App\Application\Student;

use App\Domain\Student\Student;
use App\Domain\SchoolBoard\Type as SchoolBoard;
use App\Domain\Student\Repository as StudentRepository;

/**
 * Class MemoryStudentRepository
 *
 * @package App\Application\Student
 */
class MemoryStudentRepository implements StudentRepository
{

    /**
     * @inheritDoc
     */
    public function get(): array
    {
        return [
            Student::make(1, 'John Doe', SchoolBoard::CSMB(), [6, 6, 9]),
            Student::make(2, 'Ralph Roe', SchoolBoard::CSMB(), [6, 7]),
            Student::make(3, 'Mark Moe', SchoolBoard::CSM(), [6, 8, 7, 8]),
            Student::make(4, 'Grace Goe', SchoolBoard::CSMB(), [7, 7, 8, 10]),
            Student::make(5, 'Grace Goe', SchoolBoard::CSM(), [7, 9, 9]),
            Student::make(6, 'Larry Loe', SchoolBoard::CSM(), [10, 9, 9]),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ?Student
    {
        $found = array_filter(
            $this->get(),
            function (Student $student) use ($id) {
                return $student->getStudentId() === $id;
            }
        );

        if (empty($found))
        {
            return null;
        }

        return reset($found);
    }
}