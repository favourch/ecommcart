<?php

namespace App;

use Carbon\Carbon;
use App\Common\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiftCard extends Model
{
    use SoftDeletes, Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gift_cards';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'partial_use' => 'boolean',
        'exclude_offer_items' => 'boolean',
        'exclude_tax_n_shipping' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['activation_time', 'expiry_time', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'description',
                    'serial_number',
                    'pin_code',
                    'value',
                    'remaining_value',
                    'partial_use',
                    'activation_time',
                    'expiry_time',
                    'exclude_offer_items',
                    'exclude_tax_n_shipping',
                 ];

    /**
     * Get the customer for the GiftCard.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Setters.
     */
    public function setActivationTimeAttribute($value)
    {
        if($value)
            $this->attributes['activation_time'] = Carbon::createFromFormat('Y-m-d h:i a', $value);
        else
            $this->attributes['activation_time'] = Carbon::now();
    }
    public function setExpiryTimeAttribute($value)
    {
        if($value) $this->attributes['expiry_time'] = Carbon::createFromFormat('Y-m-d h:i a', $value);
    }
    public function setPartialUseAttribute($value)
    {
        $this->attributes['partial_use'] = (bool) $value;
    }
    public function setExcludeOfferItemsAttribute($value)
    {
        $this->attributes['exclude_offer_items'] = (bool) $value;
    }
    public function setExcludeTaxNShippingAttribute($value)
    {
        $this->attributes['exclude_tax_n_shipping'] = (bool) $value;
    }

    /**
     * Check if card is in use.
     */
    public function isInUse()
    {
        return $this->customer_id && $this->activation_time <= Carbon::now() && $this->expiry_time > Carbon::now();
    }

    /**
     * Check if card hasRemaining.
     */
    public function hasRemaining()
    {
        if($this->value == $this->remaining_value)
            return true;

        return ($this->remaining_value > 0) && $this->partial_use;
    }

    /**
     * Scope a query to only include valid cards.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeValid($query)
    {
        return $query->where('expiry_time', '>', Carbon::now())->notUsed();
    }

    /**
     * Scope a query to only include Invalid cards.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInvalid($query)
    {
        return $query->where('expiry_time', '<', Carbon::now())
        ->orWhere(function($query){
            return $query->used();
        });
    }

    /**
     * Scope a query to only include used cards.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsed($query)
    {
        return $query->where('remaining_value', '<=', 0)
        ->orWhere(function($query)
                {
                    return $query->whereColumn('remaining_value', '<', 'value')->where('partial_use', '!=', 1);
                });
    }

    /**
     * Scope a query to only include not used cards.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotUsed($query)
    {
        return $query->whereColumn('value', 'remaining_value')
        ->orWhere(function($query)
                {
                    return $query->where('remaining_value', '>', 0)->where('partial_use', 1);
                });
    }
}
