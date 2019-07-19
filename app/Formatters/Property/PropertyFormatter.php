<?php

namespace Spotahome\Formatters\Property;

interface PropertyFormatter
{
    /**
     * Formats properties.
     *
     * @param array $input
     *
     * @return string
     */
    public function format($input): string;
}
