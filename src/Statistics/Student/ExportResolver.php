<?php

namespace App\Statistics\Student;

use Exception;
use App\Domain\Student\Student;

/**
 * Class ExportResolver
 *
 * @package App\Statistics\Student
 */
class ExportResolver
{

    /**
     * Exporter factory
     *
     * @param  Student $student
     *
     * @return Exporter
     *
     * @throws Exception
     */
    public static function makeExporter(Student $student)
    {
        $type = $student->getSchoolBoard()->getExportType();

        $class = __NAMESPACE__ . '\\Handlers\\' . (strtolower($type)) . 'Handler';

        if ( ! class_exists($class))
        {
            throw new Exception('Exporter handler not found.');
        }

        return new $class($student);
    }
}