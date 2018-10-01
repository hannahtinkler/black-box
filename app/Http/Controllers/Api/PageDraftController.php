<?php

namespace App\Http\Controllers\Api;

use App\Models\PageDraft;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChapterRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PageDraftRepository;

class PageDraftController extends Controller
{
    /**
     * @var PageDraftRepository
     */
    public $drafts;

    /**
     * @param PageDraftRepository $drafts
     */
    public function __construct(
        PageDraftRepository $drafts,
        CategoryRepository $categories,
        ChapterRepository $chapters
    ) {
        $this->drafts = $drafts;
        $this->chapters = $chapters;
        $this->categories = $categories;
    }

    /**
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $input = array_merge($request->input(), ['user_id' => $user->id]);

        if (!empty($input['category']) && !empty($input['chapter'])) {
            $category = $this->categories->resolve($input['category']);
            $chapter = $this->chapters->resolve($category, $input['chapter']);
            $input = array_merge($input, ['chapter_id' => $chapter->id]);
        }

        $draft = $this->drafts->store($input);
        $draft = $this->drafts->transform($draft);

        return response()->json($draft);
    }

    /**
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, PageDraft $draft)
    {
        //is draft owner
        $user = $request->user();
        $input = $request->input();

        if (!empty($input['category']) && !empty($input['chapter'])) {
            $category = $this->categories->resolve($input['category']);
            $chapter = $this->chapters->resolve($category, $input['chapter']);
            $input = array_merge($input, ['chapter_id' => $chapter->id]);
        }

        $this->drafts->update($draft, $input);
        $draft = $this->drafts->transform($draft);

        return response()->json($draft);
    }
}
