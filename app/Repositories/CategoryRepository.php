<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function all(string $orderBy = 'order')
    {
        return Category::orderBy($orderBy)->get();
    }
}
