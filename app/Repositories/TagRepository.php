<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Language;
use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class TagRepository implements TagRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllTags(): Collection
    {
        return Tag::all();
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $page, int $perPage): LengthAwarePaginator
    {
        return Tag::with(['translations', 'translations.language'])->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @param $tagId
     * @return mixed
     */
    public function getTagById($tagId): mixed
    {
        return Tag::findOrFail($tagId);
    }

    /**
     * @param $tagId
     * @return void
     */
    public function deleteTag($tagId): void
    {
        Tag::destroy($tagId);
    }

    /**
     * @param array $tagTranslations
     * @return Tag
     */
    public function createTag(array $tagTranslations): Tag
    {
        $post = Tag::create([]);
        $post->languages()->attach($tagTranslations['languageId'], Arr::only($tagTranslations, ['name']));

        return $post;
    }

    /**
     * @param $tagId
     * @param array $newTagTranslations
     * @return mixed
     */
    public function updateTag($tagId, array $newTagTranslations): mixed
    {
        return Tag::whereId($tagId)->update($newTagTranslations);
    }
}
