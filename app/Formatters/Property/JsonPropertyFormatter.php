<?php

namespace Spotahome\Formatters\Property;

use Arr;

class JsonPropertyFormatter implements PropertyFormatter
{
    /**
     * {@inheritdoc}
     */
    public function format($input): string
    {
        $properties = Arr::get($input, 'items', []);

        return json_encode($properties);
    }
}
