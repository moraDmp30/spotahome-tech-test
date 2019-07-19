<?php

namespace Spotahome\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() : \Illuminate\Contracts\Support\Renderable
    {
        $defaultField = config('spotahome.default-sort-field');
        $defaultDirection = config('spotahome.default-sort-direction');

        $repo = app()->make('Spotahome\Repositories\Property\PropertyRepository');
        $repo->getProperties([]);

        return view('home', compact('defaultField', 'defaultDirection'));
    }
}
