<?php


namespace App\Domain\Student;

/**
 * Interface Repository
 *
 * @package App\Domain\Student\
 */
interface Repository
{

    /**
     * @return array
     */
    public function get(): array;

    /**
     * @param  int $id
     *
     * @return Student|null
     */
    public function getById(int $id): ?Student;
}