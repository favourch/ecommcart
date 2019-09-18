<?php

namespace App\Common;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on Feedbacks
 *
 * @author Munna Khan
 */
trait Feedbackable {

	/**
	 * Check if model has any Feedbacks.
	 *
	 * @return bool
	 */
	public function hasFeedbacks()
	{
		return (bool) $this->feedbacks()->count();
	}

	/**
	 * Return collection of Feedbacks related to the replied model
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function Feedbacks()
	{
        return $this->morphMany(\App\Feedback::class, 'feedbackable');
	}

	public function averageFeedback()
    {
        return $this->morphMany(\App\Feedback::class, 'feedbackable')->avg('rating');
    }

    public function sumFeedback()
    {
        return $this->feedbacks()->sum('rating');
    }
    public function userAverageFeedback()
    {
        return $this->feedbacks()->where('customer_id', \Auth::guard('customer')->id())->avg('rating');
    }
    public function customerSumFeedback()
    {
        return $this->feedbacks()->where('customer_id', \Auth::guard('customer')->id())->sum('rating');
    }
    public function ratingPercent($max = 5)
    {
        $quantity = $this->feedbacks()->count();
        $total = $this->sumFeedback();
        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }
    public function getAverageFeedbackAttribute()
    {
        return $this->averageFeedback();
    }
    public function getSumFeedbackAttribute()
    {
        return $this->sumFeedback();
    }
    public function getCustomerAverageFeedbackAttribute()
    {
        return $this->userAverageFeedback();
    }
    public function getCustomerSumFeedbackAttribute()
    {
        return $this->customerSumFeedback();
    }

	/**
	 * Deletes all the Feedbacks of this model.
	 *
	 * @return bool
	 */
	public function flushFeedbacks()
	{
		$feedbacks = $this->feedbacks();

		foreach ($feedbacks->get() as $feedback){
			if($feedback->hasAttachments())
		        $feedback->flushAttachments();
		}

		return $feedbacks->delete();
	}
}