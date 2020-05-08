<?php

namespace App\Statistics\Student\Handlers;

use SimpleXMLElement;
use App\Statistics\Student\Exporter;

/**
 * Class XmlHandler
 *
 * @package App\Statistics\Student\Handlers
 */
class XmlHandler extends Exporter
{

    /**
     * @param  array $data
     *
     * @return SimpleXMLElement
     */
    private function makeXml($data): SimpleXMLElement
    {
        $xml = new SimpleXMLElement('<xml/>');

        foreach ($data as $key => $value)
        {
            if ( ! is_array($value))
            {
                $xml->addChild($key, $value);
                continue;
            }

            // Assuming grades indxed array
            $keyChild = $xml->addChild($key);
            foreach ($value as $item)
            {
                $keyChild->addChild('value', $item);
            }
        }

        return $xml;
    }

    /**
     * @inheritDoc
     */
    public function export()
    {
        $data = $this->toArray();

        $xml = $this->makeXml($data);

        return $xml->asXML();
    }
}