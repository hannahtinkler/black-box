<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function select(Request $request, Category $category)
    {
        $request->user()->update(['default_category_id' => $category->id]);

        return redirect()->back();
    }
}
