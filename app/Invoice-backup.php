<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoicebackup extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'date_invoice', 'date_payment'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
                    'shop_id',
                    'order_id',
                    'customer_id',
                    'total',
                    'shipping',
                    'discount',
                    'tax_amount',
                    'grand_total',
                    'paid',
                    'tax_id',
                    'payment_date',
                    'payment_status_id',
                    'payment_method_id',
                    'payment_date',
                ];

    /**
     * Get the customer associated with the invoice.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the shop associated with the invoice.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }


    /**
     * Get the tax associated with the cart.
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * Get the order associated with the cart.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the paymentMethod for the invoice.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
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
     * Set tag date formate
     */
    public function setPaymentDateAttribute($date){
        $this->attributes['payment_date']= Carbon::createFromFormat('Y-m-d', $date);
    }
}
