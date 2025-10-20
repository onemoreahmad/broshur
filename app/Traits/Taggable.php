<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Tag;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(Tag::class, 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order');
    }

    public function categories(): MorphToMany
    {
        return $this
            ->morphToMany(Tag::class, 'taggable', 'taggables', null, 'tag_id')
            ->wherePivot('type', 'category')
            ->orderBy('order');
    }
 
    public function attachTag($tag, $type = null)
    {
        return $this->tags()->attach([$tag->id], ['type' => $type]);
    }

    public function detashTag($tag)
    {
        return $this->tags()->detach([$tag->id]);
    }

    public function scopeWithAnyTags($query, $tags, string $type = null): Builder
    {
        return $query
            ->whereHas('tags', function (Builder $query) use ($tags) {
                // $tags = collect($tags)->pluck('id');
  
                $query->whereIn('tags.id', $tags);
            });
    }

    public function syncTag($tag, $type = null)
    {
        if (is_array($tag)) {
            $ids = collect($tag)->mapWithKeys(function ($item) use ($type) {
                return [$item => ['type' => $type]];
            })->toArray();

            return $this->tags()->sync($ids);
        }
 
        return $this->tags()->sync([$tag], ['type' => $type]);
    }
}
