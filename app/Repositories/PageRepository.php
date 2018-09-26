<?php

namespace App\Repositories;

use App\Models\Page;
use App\Services\Versioner;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Database\Eloquent\Collection;

class PageRepository
{
    /**
     * @var Page
     */
    public $model;

    /**
     * @param Page                $model
     * @param Versioner           $versioner
     * @param CommonMarkConverter $converter
     */
    public function __construct(
        Page $model,
        Versioner $versioner,
        CommonMarkConverter $converter
    ) {
        $this->model = $model;
        $this->versioner = $versioner;
        $this->converter = $converter;
    }

    /**
     * @param  string $slug
     * @return Page|null
     */
    public function getBySlug(string $slug) : ?Page
    {
        return $this->model->whereSlug($slug)->first();
    }

    /**
     * @param  array  $data
     * @return Page
     */
    public function store(array $data) : Page
    {
        $page = $this->model->create([
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'has_resources' => $data['has_resources'],
            'created_by' => $data['user_id'],
        ]);

        return $page;
    }

    /**
     * @param  Page $page
     * @return Page
     */
    public function transform(Page $page) : Page
    {
        $page->html = $this->converter->convertToHtml($page->content);

        return $page;
    }

    /**
     * Records the current state as a previous version and then updates the page
     * @param  Page   $page
     * @param  array  $data
     * @return Page
     */
    public function update(Page $page, array $data) : Page
    {
        $this->versioner->make(clone $page);

        $page->chapter_id = $data['chapter_id'];
        $page->title = $data['title'];
        $page->description = $data['description'];
        $page->content = $data['content'];
        $page->has_resources = $data['has_resources'];
        $page->save();

        return $page;
    }
}
