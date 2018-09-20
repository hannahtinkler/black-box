<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChapterRepository;

class ChapterController extends Controller
{
    /**
     * @var ChapterRepository
     */
    public $repository;

    /**
     * @param ChapterRepository $repository
     */
    public function __construct(ChapterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $chapters = $this->repository->search($request->input());

        return response()->json($chapters);
    }
}
