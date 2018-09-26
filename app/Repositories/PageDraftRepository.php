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
            ? $draft->updated_at->format('jS F Y H:i:sa')
            : $draft->created_at->format('jS F Y H:i:sa');

        return $draft;
    }

    /**
     * @param  array  $data
     * @return PageDraft
     */
    public function store(array $data) : PageDraft
    {
        $draft = $this->model->create([
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'has_resources' => $data['has_resources'],
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
        $draft->chapter_id = $data['chapter_id'];
        $draft->title = $data['title'];
        $draft->description = $data['description'];
        $draft->content = $data['content'];
        $draft->has_resources = $data['has_resources'];
        $draft->save();

        return $draft;
    }
}
