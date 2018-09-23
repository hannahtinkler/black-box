<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('home.index');
    }
}
