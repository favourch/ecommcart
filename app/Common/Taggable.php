<?php

namespace App\Common;

use App\Tag;

/**
 * Attach this Trait to a model to have the ability of tagging
 *
 * @author Munna Khan
 */
trait Taggable {

    /**
     * Get all of the tags for the model.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get the tag list for edit form.
     *
     * @return array
     */
    public function getTagListAttribute()
    {
         if (count($this->tags)) return $this->tags->pluck('id')->toArray();
    }

    /**
     * Sync up the tags the taggable model and create new tags if not exist
     *
     * @param  Model $taggable Taggable Model
     * @param  array $tagIds
     * @return void
     */
    public function syncTags($taggable, array $tagIds)
    {
        $tags = [];
        foreach ($tagIds as $id){
            if (is_numeric($id)){
                $tags[] =  $id;
            }else{
                // if the tag not numeric that means that its new tag and we should create it
                $newTag = Tag::firstOrCreate(['name' => $id]);
                $tags[] = $newTag->id;
            }
        }

        return $taggable->tags()->sync($tags);
    }

    /**
     * Detach all tags for the taggable model
     *
     * @param  int $id
     * @param  str $taggable
     * @return void
     */
    public function detachTags($id, $taggable)
    {
        $taggable_type = get_qualified_model($taggable);

        return \DB::table('taggables')->where('taggable_id', $id)->where('taggable_type', $taggable_type)->delete();
    }
}