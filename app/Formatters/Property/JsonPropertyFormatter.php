<?php

namespace Spotahome\Formatters\Property;

class JsonPropertyFormatter implements PropertyFormatter
{
    /**
     * {@inheritdoc}
     */
    public function format($input): string
    {
        $properties = $input;

        return json_encode($properties);
    }
}
