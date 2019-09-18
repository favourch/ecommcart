<?php

namespace App\Common;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on Replies
 *
 * @author Munna Khan
 */
trait Repliable {

	/**
	 * Check if model has any Replies.
	 *
	 * @return bool
	 */
	public function hasReplies()
	{
		return (bool) $this->replies()->count();
	}

	/**
	 * Return collection of Replies related to the replied model
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function replies()
	{
        return $this->morphMany(\App\Reply::class, 'repliable');
	}

	/**
	 * Deletes all the Replies of this model.
	 *
	 * @return bool
	 */
	public function flushReplies()
	{
		$replies = $this->replies();

		foreach ($replies->get() as $reply){
			if($reply->hasAttachments())
		        $reply->flushAttachments();
		}

		return $replies->delete();
	}
}