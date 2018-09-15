<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class CategoryMenuComposer
{
    /**
     * @var CategoryRepository
     */
    protected $categories;

    /**
     * @param Request            $request
     * @param CategoryRepository $categories
     */
    public function __construct(Request $request, CategoryRepository $categories)
    {
        $this->user = $request->user();
        $this->categories = $categories;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = $this->categories->all()->sortBy(function ($category) {
            return $this->user->default_category_id == $category->id ? 0 : $category->id;
        })->values();

        $view->with('categories', $categories);
    }
}
