<?php

namespace App;

use App\Common\Attachable;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use Attachable;

   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
					'customer_id',
					'rating',
					'comment',
					'feedbackable_id',
					'feedbackable_type',
					'approved',
					'spam'
				];

    /**
     * Get all of the owning feedbackable models.
     */
    public function feedbackable()
    {
        return $this->morphTo();
    }

    /**
     * Get the customer associated with the model.
    */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Set the rating for the model.
     */
    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = $value ? (int) $value : 1;
    }
}