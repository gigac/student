<?php

namespace App\Application\Student;

use PDO;
use App\Domain\Student\Student;
use App\Domain\SchoolBoard\Type as SchoolBoard;
use App\Domain\Student\StudentNotFoundException;
use App\Domain\Student\Repository as StudentRepository;

/**
 * Class MysqlStudentRepository
 *
 * @package App\Application\Student
 */
class MysqlStudentRepository implements StudentRepository
{

    /**
     * @var PDO
     */
    private $db;

    /**
     * MysqlStudentRepository constructor.
     *
     * @param  PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }

    /**
     * @inheritDoc
     */
    public function get(): array
    {
        $students = $this->db->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
        $studentIds = implode(',', array_column($students, 'id'));

        // Eager load grades
        $grades = $this->db->query("SELECT * FROM student_grades WHERE student_id IN ($studentIds)")
                           ->fetchAll(PDO::FETCH_ASSOC);

        $data = [];
        foreach ($students as $row)
        {
            $studentGrades = array_filter($grades, function ($grade) use ($row) {
                return $grade['student_id'] == $row['id'];
            });

            $data[] = Student::make(
                (int)$row['id'],
                $row['name'],
                $row['school_board'] == 'CSMB' ? SchoolBoard::CSMB() : SchoolBoard::CSM(),
                array_map('intval', array_column($studentGrades, 'grade'))
            );
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): Student
    {
        $student = $this->db->query("SELECT * FROM students WHERE id=$id")->fetch(PDO::FETCH_ASSOC);

        if ( ! $student)
        {
            throw new StudentNotFoundException('Student not found.');
        }

        $grades = $this->db->query("SELECT * FROM student_grades WHERE student_id=$id")->fetchAll(PDO::FETCH_ASSOC);
        $studentGrades = array_filter($grades, function ($grade) use ($id) {
            return $grade['student_id'] == $id;
        });

        return Student::make(
            (int)$student['id'],
            $student['name'],
            $student['school_board'] == 'CSMB' ? SchoolBoard::CSMB() : SchoolBoard::CSM(),
            array_map('intval', array_column($studentGrades, 'grade'))
        );
    }
}