<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'path',
                    'extension',
                    'size',
                    'attachable_id',
                    'attachable_type',
                ];

    /**
     * Get all of the owning attachable models.
     */
	public function attachable()
    {
        return $this->morphTo();
    }
}
