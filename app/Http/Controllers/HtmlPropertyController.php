<?php

namespace Spotahome\Http\Controllers;

use \Illuminate\Http\Request;
use Spotahome\Formatters\Property\PropertyFormatter;
use Spotahome\Repositories\Property\PropertyRepository;

class HtmlPropertyController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProperties(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'html' => $this->formatter->format($this->property->getProperties($request->all())),
            ]);
        } catch (Exception $e) {
            Log::error($e);

            return response()->json([
                'error' => 'Unable to load properties',
            ], 400);
        }
    }
}
