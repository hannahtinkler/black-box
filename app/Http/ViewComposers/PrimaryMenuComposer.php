<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repositories\ChapterRepository;

class PrimaryMenuComposer
{
    /**
     * @var ChapterRepository
     */
    protected $chapters;

    /**
     * @param Request            $request
     * @param ChapterRepository  $chapters
     */
    public function __construct(Request $request, ChapterRepository $chapters)
    {
        $this->user = $request->user();
        $this->chapters = $chapters;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $chapters = $this->chapters->getByCategoryId($this->user->default_category_id)->load('pages');

        $view->with('chapters', $chapters);
    }
}
