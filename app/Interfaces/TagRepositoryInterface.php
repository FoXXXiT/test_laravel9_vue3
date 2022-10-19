<?php

namespace App\Interfaces;

interface TagRepositoryInterface
{
    public function getAllTags();
    public function paginate(int $page, int $perPage);
    public function getTagById(int $tagId);
    public function deleteTag(int $tagId);
    public function createTag(array $tagTranslations);
    public function updateTag(int $tagId, array $newTagTranslations);
}
