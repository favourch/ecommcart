<?php

namespace App;

use Auth;
use App\Common\Loggable;
use App\Common\Repliable;
use App\Common\Attachable;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    use Repliable, Attachable, Loggable;

	const STATUS_NEW       = 1; 		//Default
    const STATUS_OPEN      = 2;
    const STATUS_WAITING   = 3;
    const STATUS_APPEALED  = 4;
    const STATUS_SOLVED    = 5;
    const STATUS_CLOSED    = 6;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'disputes';

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'disput';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'shop_id',
                    'dispute_type_id',
                    'customer_id',
                    'order_id',
                    'product_id',
                    'description',
                    'order_received',
                    'return_goods',
                    'refund_amount',
                    'status',
                ];

    /**
     * Get the shop associated with the model.
    */
    public function shop()
    {
        return $this->belongsTo(Shop::class)->withDefault();
    }

    /**
     * Get the customer associated with the model.
    */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault();
    }

    /**
     * Get the Dispute type associated with the model.
    */
    public function dispute_type()
    {
        return $this->belongsTo(DisputeType::class, 'dispute_type_id');
    }

    /**
     * Get the product associated with the model.
    */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the order associated with the model.
    */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Setters
     */
    public function setProductIdAttribute($value)
    {
        if(is_numeric($value))
            $this->attributes['product_id'] = $value;
        else
            $this->attributes['product_id'] = Null;
    }

    /**
     * Scope a query to only include appealed disputes.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAppealed($query)
    {
        return $query->where('status', static::STATUS_APPEALED);
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
    public function scopeOpen($query)
    {
        return $query->where('status' , '<', static::STATUS_SOLVED);
    }

    /**
     * Scope a query to only include records from the users shop.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClosed($query)
    {
        return $query->where('status', '>=', static::STATUS_SOLVED);
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
     * Return true if the disput is closed
     */
    public function isClosed()
    {
        return $this->status >= static::STATUS_SOLVED;
    }

	public function statusName()
    {
        switch ($this->status) {
            case static::STATUS_NEW: return '<span class="label label-outline">' . trans('app.statuses.new') . '</span>';
            case static::STATUS_OPEN: return '<span class="label label-primary">' . trans('app.statuses.open') . '</span>';
            case static::STATUS_WAITING: return '<span class="label label-info">' . trans('app.statuses.waiting') . '</span>';
            case static::STATUS_APPEALED: return '<span class="label label-danger">' . trans('app.statuses.appealed') . '</span>';
            case static::STATUS_SOLVED: return '<span class="label label-success">' . trans('app.statuses.solved') . '</span>';
            case static::STATUS_CLOSED: return '<span class="label label-warning">' . trans('app.statuses.closed') . '</span>';
        }
    }
}
