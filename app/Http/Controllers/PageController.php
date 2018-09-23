<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Page;
use App\Models\Chapter;
use App\Models\Category;

use App\Repositories\PageRepository;
use App\Repositories\ChapterRepository;
use App\Repositories\CategoryRepository;

use Illuminate\Http\Request;
use App\Http\Requests\Pages\StoreRequest;

class PageController extends Controller
{
    /**
     * @var PageRepository
     */
    public $pages;

    /**
     * @param PageRepository $pages
     */
    public function __construct(
        PageRepository $pages,
        CategoryRepository $categories,
        ChapterRepository $chapters
    ) {
        $this->pages = $pages;
        $this->chapters = $chapters;
        $this->categories = $categories;
    }

    /**
     * @param  Request  $request
     * @return View
     */
    public function create(Request $request)
    {
        return view('pages.create');
    }

    /**
     * @param  Request $request
     * @param  Page    $page
     * @return View
     */
    public function edit(Request $request, Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * @param  Request $request
     * @param  string  $category
     * @param  string  $chapter
     * @param  string  $page
     * @return View
     */
    public function show(
        Request $request,
        string $category,
        string $chapter,
        string $page
    ) {
        $page = $this->pages->getBySlug($page);

        return view('pages.show', [
            'page' => $this->pages->transform($page),
        ]);
    }

    /**
     * @param  StoreRequest $request
     * @return Redirect
     */
    public function store(StoreRequest $request)
    {
        $user = $request->user();
        $input = $request->input();

        $category = $this->categories->resolve($input['category']);
        $chapter = $this->chapters->resolve($category, $input['chapter']);

        $page = $this->pages->store(
            array_merge($input, [
                'user_id' => $user->id,
                'chapter_id' => $chapter->id,
            ])
        );

        // if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
        //     $this->drafts->delete($data['last_draft_id']);
        // }

        // if ($page->approved) {
        //     Event::fire(new PageWasAdded($page, $user));
        // }

        return redirect()->to($page->permalink())
            ->with('message', 'This page has been saved and you\'re now viewing it.');
    }

    /**
     * @param  StoreRequest $request
     * @param  Page         $page
     * @return Redirect
     */
    public function update(StoreRequest $request, Page $page)
    {
        $user = $request->user();
        $input = $request->input();

        $category = $this->categories->resolve($input['category']);
        $chapter = $this->chapters->resolve($category, $input['chapter']);

        $page = $this->pages->update(
            $page,
            array_merge($input, [
                'chapter_id' => $chapter->id,
            ])
        );

        // if (isset($data['last_draft_id']) && !empty($data['last_draft_id'])) {
        //     $this->drafts->delete($data['last_draft_id']);
        // }

        // if ($page->approved) {
        //     Event::fire(new PageWasEdited($page, $user));
        // }

        return redirect()->to($page->permalink())
            ->with('message', 'This page has been upated and you\'re now viewing your changes.');
    }
}
