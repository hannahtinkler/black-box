<?php

namespace App\Repositories;

use App\Models\Chapter;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class ChapterRepository
{
    /**
     * @var Chapter
     */
    public $model;

    /**
     * @param Chapter $model
     */
    public function __construct(Chapter $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all() : Collection
    {
        return $this->model->orderBy('order')->get();
    }

    /**
     * @param  int    $id
     * @return Collection
     */
    public function getByCategoryId(int $id) : Collection
    {
        return $this->model->whereCategoryId($id)->orderBy('order')->get();
    }

    /**
     * Turns a title string into a chapter, either by retrieving an existing one
     * or creating one
     *
     * @param  Category $category
     * @param  string   $chapter
     * @return Chapter
     */
    public function resolve(Category $category, string $chapter) : Chapter
    {
        return $this->model->firstOrCreate([
            'title' => $chapter,
            'category_id' => $category->id,
        ]);
    }

    /**
     * @param  array  $data
     * @return Collection
     */
    public function search(array $data) : Collection
    {
        $chapters = $this->model->orderBy('order', 'ASC')->orderBy('title', 'DESC');

        if (isset($data['category_id'])) {
            $chapters->whereCategoryId($data['category_id']);
        }

        return $chapters->get();
    }
}
