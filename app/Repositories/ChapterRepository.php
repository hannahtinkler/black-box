<?php

namespace App\Repositories;

use App\Models\Chapter;

class ChapterRepository
{
    public function all()
    {
        return Chapter::orderBy('order')->get();
    }

    public function getByCategoryId(int $id)
    {
        return Chapter::whereCategoryId($id)->orderBy('order')->get();
    }
}
