<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dashboard_configs';


    /**
     * The database primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The primanry key is not incrementing
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'upgrade_plan_notice' => 'boolean',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
