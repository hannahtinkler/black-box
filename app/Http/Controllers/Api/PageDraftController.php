<?php

namespace App\Http\Controllers\Api;

use App\Models\PageDraft;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PageDraftRepository;

class PageDraftController extends Controller
{
    /**
     * @var PageDraftRepository
     */
    public $repository;

    /**
     * @param PageDraftRepository $repository
     */
    public function __construct(PageDraftRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->input();

        $draft = $this->repository->store(
            array_merge($data, ['user_id' => $user->id])
        );

        $draft = $this->repository->transform($draft);

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
        $data = $request->input();

        $this->repository->update($draft, $data);

        $draft = $this->repository->transform($draft);

        return response()->json($draft);
    }
}
