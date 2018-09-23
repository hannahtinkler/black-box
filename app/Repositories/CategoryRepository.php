<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @var Category
     */
    public $model;

    /**
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @param  string $orderBy
     * @return Collection
     */
    public function all(string $orderBy = 'order') : Collection
    {
        return $this->model->orderBy($orderBy)->get();
    }

    /**
     * Turns a title string into a categort, either by retrieving an existing
     * one or creating one
     *
     * @param  string   $category
     * @return Category
     */
    public function resolve(string $category) : Category
    {
        return $this->model->firstOrCreate([
            'title' => $category,
        ]);
    }
}
