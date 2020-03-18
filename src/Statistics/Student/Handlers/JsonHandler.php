<?php

namespace App\Statistics\Student\Handlers;

use App\Statistics\Student\Exporter;

/**
 * Class JsonHandler
 *
 * @package App\Statistics\Student\Handlers
 */
class JsonHandler extends Exporter
{

    /**
     * @inheritDoc
     */
    public function export()
    {
        return json_encode(
            $this->toArray()
        );
    }
}