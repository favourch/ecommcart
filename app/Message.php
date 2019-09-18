<?php

namespace App;

use Auth;
use App\Scopes\MineScope;
use App\Common\Repliable;
use App\Common\Attachable;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Repliable, Attachable;

	const STATUS_NEW     = 1; 		//Default
    const STATUS_UNREAD  = 2;       //All status before UNREAD value consider as unread
    const STATUS_READ    = 3;

    const LABEL_INBOX   = 1;       //Default
    const LABEL_SENT    = 2;
    const LABEL_DRAFT   = 3;       //All labels before this DRAFT can be replied and All labels after this DRAFT can be deleted permanently
    const LABEL_SPAM    = 4;
    const LABEL_TRASH   = 5;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'shop_id',
                    'customer_id',
                    'subject',
                    'message',
                    'label',
                    'status',
                ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    // protected static function boot()
    // {
    //     parent::boot();

    //     if(Auth::check()){
    //         static::addGlobalScope(new MineScope);
    //     }
    // }

    /**
     * Get the shop associated with the model.
    */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the user associated with the model.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customer associated with the model.
    */
    public function customer()
    {
        return $this->belongsTo(Customer::class)->withoutGlobalScope('MineScope');
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
     * Scope a query to only include records that have the given label.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLabelOf($query, $label)
    {
        return $query->where('label', $label);
    }

    /**
     * Scope a query to only include records from the user.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyMessages($query)
    {
        return $query->where('customer_id', Auth::id());
    }

    /**
     * Scope a query to only include unread messages.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('status', '<', self::STATUS_READ);
    }

    /**
     * Scope a query to only include spam messages.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSpam($query)
    {
        return $query->where('status', self::STATUS_SPAM);
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

    public function about()
    {
        $str = '';
        if($this->order_id)
            $str .= '<span class="label label-outline">' . trans('app.order') . '</span>';
        else if($this->product_id)
            $str .= '<span class="label label-outline">' . trans('app.product') . '</span>';

        return $str;
    }

    public function labelName()
    {
        switch ($this->label) {
            case static::LABEL_INBOX: return '<span class="label label-info">' . trans('app.message_labels.inbox') . '</span>';
            case static::LABEL_SENT: return '<span class="label label-outline">' . trans('app.message_labels.sent') . '</span>';
            case static::LABEL_DRAFT: return '<span class="label label-default">' . trans('app.message_labels.draft') . '</span>';
            case static::LABEL_SPAM: return '<span class="label label-danger">' . trans('app.message_labels.spam') . '</span>';
            case static::LABEL_TRASH: return '<span class="label label-warning">' . trans('app.message_labels.trash') . '</span>';
        }
    }

    public function statusName()
    {
        switch ($this->status) {
            case static::STATUS_NEW: return '<span class="label label-info">' . trans('app.statuses.new') . '</span>';
            case static::STATUS_UNREAD: return '<span class="label label-outline">' . trans('app.statuses.unread') . '</span>';
            case static::STATUS_READ: return '<span class="label label-default">' . trans('app.statuses.read') . '</span>';
        }
    }
}
