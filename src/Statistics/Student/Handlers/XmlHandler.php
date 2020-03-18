<?php

namespace App\Statistics\Student\Handlers;

use Spatie\ArrayToXml\ArrayToXml;
use App\Statistics\Student\Exporter;

/**
 * Class XmlHandler
 *
 * @package App\Statistics\Student\Handlers
 */
class XmlHandler extends Exporter
{

    /**
     * @inheritDoc
     */
    public function export()
    {
        $data = $this->toArray();

        $grades = array_map(function ($item) {
            return ['value' => $item];
        }, $data['grades']);

        $data['results'] = [
            'pass'   => $data['final_result'],
            'grades' => $grades,
        ];

        return ArrayToXml::convert($data, 'Student', true, null, '1.0', ['formatOutput' => true]);
    }
}