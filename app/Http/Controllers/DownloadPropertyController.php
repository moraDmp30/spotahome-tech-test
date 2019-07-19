<?php

namespace Spotahome\Http\Controllers;

use Illuminate\Http\Request;
use Spotahome\Formatters\Property\PropertyFormatter;
use Spotahome\Repositories\Property\PropertyRepository;

class DownloadPropertyController extends Controller
{
    /**
     * @var \Spotahome\Repositories\Property\PropertyRepository
     */
    protected $property;

    /**
     * @var \Spotahome\Formatters\Property\PropertyFormatter
     */
    protected $formatter;

    /**
     * Create a new controller instance.
     *
     * @param \Spotahome\Repositories\Property\PropertyRepository $property
     * @param \Spotahome\Formatters\Property\PropertyFormatter    $formatter
     */
    public function __construct(PropertyRepository $property, PropertyFormatter $formatter)
    {
        $this->property = $property;
        $this->formatter = $formatter;
    }

    /**
     * Handle properties download.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadProperties(Request $request): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return response()->streamDownload(function () use ($request) {
            echo $this->formatter->format($this->property->getProperties($request->all()));
        }, 'properties.json');
    }
}
