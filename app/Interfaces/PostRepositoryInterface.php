<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function paginate(int $page, int $perPage);
    public function getPostById(int $postId);
    public function deletePost(int $postId);
    public function createPost(array $postTranslations);
    public function updatePost(int $postId, array $newPostTranslations);
}
