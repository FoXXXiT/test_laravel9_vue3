<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Language;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllPosts(): Collection
    {
        return Post::all();
    }

    public function paginate(int $page, int $perPage): LengthAwarePaginator
    {
        return Post::with(['translations', 'translations.language'])->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @param $postId
     * @return mixed
     */
    public function getPostById($postId): mixed
    {
        return Post::findOrFail($postId);
    }

    /**
     * @param $postId
     * @return void
     */
    public function deletePost($postId): void
    {
        Post::destroy($postId);
    }

    /**
     * @param array $postTranslations
     * @return Post
     */
    public function createPost(array $postTranslations): Post
    {
        $post = Post::create([]);
        $post->languages()->attach($postTranslations['languageId'], Arr::only($postTranslations, ['title', 'description', 'content']));

        return $post;
    }

    /**
     * @param $postId
     * @param array $newPostTranslations
     * @return mixed
     */
    public function updatePost($postId, array $newPostTranslations): mixed
    {
        return Post::whereId($postId)->update($newPostTranslations);
    }
}
