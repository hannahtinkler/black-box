<?php

namespace App\Repositories;

use App\Models\PageDraft;
use App\Services\Versioner;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Database\Eloquent\Collection;

class PageDraftRepository
{
    /**
     * @var PageDraft
     */
    public $model;

    /**
     * @param PageDraft $model
     */
    public function __construct(PageDraft $model)
    {
        $this->model = $model;
    }

    /**
     * @param  PageDraft $draft
     * @return PageDraft
     */
    public function transform(PageDraft $draft) : PageDraft
    {
        $draft->updated_at_formatted = $draft->updated_at
            ? $draft->updated_at->format('jS F Y H:ia')
            : $draft->created_at->format('jS F Y H:ia');

        return $draft;
    }

    /**
     * @param  array  $data
     * @return PageDraft
     */
    public function store(array $data) : PageDraft
    {
        $draft = $this->model->create([
            'chapter_id' => $data['chapter_id'] ?? null,
            'title' => $data['title'] ?? null,
            'description' => $data['description'] ?? null,
            'content' => $data['content'] ?? null,
            'has_resources' => $data['has_resources'] ?? false,
            'created_by' => $data['user_id'],
        ]);

        return $draft;
    }

    /**
     * Records the current state as a previous version and then updates the page
     * @param  PageDraft   $draft
     * @param  array  $data
     * @return PageDraft
     */
    public function update(PageDraft $draft, array $data) : PageDraft
    {
        $draft->chapter_id = $data['chapter_id'] ?? null;
        $draft->title = $data['title'] ?? null;
        $draft->description = $data['description'] ?? null;
        $draft->content = $data['content'] ?? null;
        $draft->has_resources = $data['has_resources'] ?? false;
        $draft->save();

        return $draft;
    }
}
