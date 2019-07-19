<?php

namespace Spotahome\Formatters\Property;

use View;

class HtmlPropertyFormatter implements PropertyFormatter
{
    /**
     * {@inheritdoc}
     */
    public function format($input): string
    {
        $properties = $input;

        return View::make('partials.properties', compact('properties'))->render();
    }
}
