<?php

namespace App\Domain\SchoolBoard;

use MyCLabs\Enum\Enum;

/**
 * Class Type
 *
 * @package App\Domain\SchoolBoard
 *
 * @method  static Type CSM()
 * @method  static Type CSMB()
 */
class Type extends Enum
{

    const CSM = 'csm';
    const CSMB = 'csmb';

    /**
     * @return string
     */
    public function getExportType(): string
    {
        switch ($this->getValue())
        {
            case static::CSMB:
                return 'xml';

            case static::CSM:
            default:
                return 'json';
        }
    }
}