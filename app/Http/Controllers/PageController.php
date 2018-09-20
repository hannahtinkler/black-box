<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function create(Request $request, Category $category)
    {
        return view('pages.create');
    }
}
