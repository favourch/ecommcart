<?php

namespace App;

use Auth;
use App\Common\Repliable;
use App\Common\Attachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes, Repliable, Attachable;

	const STATUS_NEW     = 1; 		//Default
    const STATUS_OPEN    = 2;
    const STATUS_PENDING = 3;
    const STATUS_SOLVED  = 4;
    const STATUS_CLOSED  = 5;
    const STATUS_SPAM    = 6;

    const PRIORITY_LOW    	= 1;	//Default
    const PRIORITY_NORMAL 	= 2;
    const PRIORITY_HIGH   	= 3;
    const PRIORITY_CRITICAL	= 4;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tickets';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'shop_id',
                    'user_id',
                    'status',
                    'category_id',
                    'priority',
                    'subject',
                    'message',
                    'assigned_to',
                ];

    /**
     * Get the shop associated with the model.
    */
    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault([
            'name' => trans('app.vendor_not_available'),
        ]);
    }

    /**
     * Get the user associated with the model.
    */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the ticket category associated with the model.
    */
    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    /**
     * Get the ticket assigned to associated with the model.
    */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->where('shop_id', Auth::user()->merchantId());
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssignedToMe($query)
    {
        return $query->where('assigned_to', Auth::id())->where('status', '<', Ticket::STATUS_SOLVED);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnAssigned($query)
    {
        return $query->where('assign_id', Null)->where('status', '<', Ticket::STATUS_SOLVED);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {
        return $query->where('status' , '<', Ticket::STATUS_SOLVED);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClosed($query)
    {
        return $query->where('status', '>=', Ticket::STATUS_SOLVED);
    }

    /**
     * Scope a query to only include records that have the given status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatusOf($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include records that have the given priority.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePriorityOf($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedByMe($query)
    {
        return $query->where('user_id', Auth::id());
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArchived($query)
    {
        return $query->onlyTrashed();
    }

	public function statusName()
    {
        switch ($this->status) {
            case static::STATUS_NEW: return '<span class="label label-outline">' . trans('app.statuses.new') . '</span>';

            case static::STATUS_OPEN: return '<span class="label label-primary">' . trans('app.statuses.open') . '</span>';

            case static::STATUS_PENDING: return '<span class="label label-info">' . trans('app.statuses.pending') . '</span>';

            case static::STATUS_SOLVED: return '<span class="label label-success">' . trans('app.statuses.solved') . '</span>';

            case static::STATUS_CLOSED: return '<span class="label label-warning">' . trans('app.statuses.closed') . '</span>';

            case static::STATUS_SPAM: return '<span class="label label-danger">' . trans('app.statuses.spam') . '</span>';
        }
    }

	public function priorityLevel()
    {
        switch ($this->priority) {
        	case static::PRIORITY_LOW: return '<span class="label label-outline">' . trans('app.priorities.low') . '</span>';

        	case static::PRIORITY_NORMAL: return '<span class="label label-primary">' . trans('app.priorities.normal') . '</span>';

        	case static::PRIORITY_HIGH: return '<span class="label label-warning">' . trans('app.priorities.high') . '</span>';

        	case static::PRIORITY_CRITICAL: return '<span class="label label-danger">' . trans('app.priorities.critical') . '</span>';
    	}
    }
}
