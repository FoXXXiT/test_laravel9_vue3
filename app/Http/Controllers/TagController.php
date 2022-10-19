<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{

    private const PER_PAGE = 3;

    /**
     * @var TagRepository
     */
    private TagRepository $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', self::PER_PAGE);

        return new JsonResponse(
            $this->tagRepository->paginate($page, $perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return JsonResponse
     */
    public function store(TagRequest $request): JsonResponse
    {

        return new JsonResponse(
            [
                'data' => $this->tagRepository->createTag($request->validated())
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $tagId
     * @return JsonResponse
     */
    public function show(int $tagId): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->tagRepository->getTagById($tagId)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param int $tagId
     * @return Response|JsonResponse
     */
    public function update(TagRequest $request, int $tagId): Response|JsonResponse
    {
        return new JsonResponse([
            'data' => $this->tagRepository->updateTag($tagId, $request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $tagId
     * @return JsonResponse
     */
    public function destroy(int $tagId): JsonResponse
    {
        $this->tagRepository->deleteTag($tagId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
