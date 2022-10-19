<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{

    private const PER_PAGE = 3;

    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of posts.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', self::PER_PAGE);

        return new JsonResponse(
            $this->postRepository->paginate($page, $perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {

        return new JsonResponse(
            [
                'data' => $this->postRepository->createPost($request->validated())
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $postId
     * @return JsonResponse
     */
    public function show(int $postId): JsonResponse
    {
       return new JsonResponse([
            'data' => $this->postRepository->getPostById($postId)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param int $postId
     * @return Response|JsonResponse
     */
    public function update(PostRequest $request, int $postId): Response|JsonResponse
    {
     return new JsonResponse([
            'data' => $this->postRepository->updatePost($postId, $request->validated())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $postId
     * @return JsonResponse
     */
    public function destroy(int $postId): JsonResponse
    {
        $this->postRepository->deletePost($postId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
