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
        $defaultPage = config('spotahome.default-page');

        return view('home', compact('defaultField', 'defaultDirection', 'defaultPage'));
    }
}
