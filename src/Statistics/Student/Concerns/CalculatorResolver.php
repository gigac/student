<?php


namespace App\Statistics\Student\Concerns;

use App\Domain\SchoolBoard\CsmbCalculator;
use App\Domain\SchoolBoard\CsmCalculator;
use App\Domain\SchoolBoard\Type as SchoolBoard;
use App\Domain\SchoolBoard\PassCalculatorInterface;

/**
 * Trait CalculatorResolver
 *
 * @package App\Statistics\Student\Concerns
 */
trait CalculatorResolver
{

    /**
     * @var PassCalculatorInterface
     */
    private $calculator;

    /**
     * @param  SchoolBoard $type
     *
     * @return void
     */
    private function resolveCalculator(SchoolBoard $type): void
    {
        switch ($type)
        {
            case SchoolBoard::CSMB;
                $this->calculator = new CsmbCalculator();
                break;

            case SchoolBoard::CSM:
            default:
                $this->calculator = new CsmCalculator();
        }
    }
}