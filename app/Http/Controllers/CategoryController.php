<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @param  Request  $request
     * @param  Category $category
     * @return Redirect
     */
    public function select(Request $request, Category $category)
    {
        $request->user()->update(['default_category_id' => $category->id]);

        return redirect()->back();
    }
}
