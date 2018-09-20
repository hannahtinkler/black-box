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

    public function search(array $data)
    {
        $chapters = Chapter::orderBy('order', 'ASC')->orderBy('title', 'DESC');

        if (isset($data['category_id'])) {
            $chapters->whereCategoryId($data['category_id']);
        }

        return $chapters->get();
    }
}
