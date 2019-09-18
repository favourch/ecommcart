<?php

namespace App;

use App\State;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['country:id,name,country_code,iso_3166_2', 'state:id,name,country_id,iso_3166_2'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        'address_title',
                        'address_type',
                        'address_line_1',
                        'address_line_2',
                        'city',
                        'state_id',
                        'country_id',
                        'zip_code',
                        'phone',
                        'addressable_id',
                        'addressable_type',
                        'latitude',
                        'longitude',
                    ];

    /**
     * Get all of the owning addressable models.
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    /**
     * Get the country of the address.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the state of the address.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Creat new state and set the id if the given value is not available
     */
    public function setStateIdAttribute($value)
    {
        if (!is_numeric($value) and $value != NULL){
            $state = State::firstOrCreate(['name' => $value, 'country_id' => \Request::input('country_id')]);
            $value = $state->id;
        }

        $this->attributes['state_id'] = $value;
    }

    /**
     * Try to fetch the coordinates from Google
     * and store it to database
     *
     * @return $this
     */
    public function toGeocodeString()
    {
        $data = [];
        $data[] = $this->address_line_1 ?? '';
        $data[] = $this->address_line_2 ?? '';
        $data[] = $this->city ?? '';
        if ($this->state_id)
            $data[] = $this->state->name;
        $data[] = $this->zip_code ?? '';
        if ($this->country_id)
            $data[] = $this->country->name;

        // build str string
        $str = trim( implode(', ', array_filter($data)) );

        return str_replace(' ', '+', $str);
    }

    /**
     * Formate the address toHtml
     *
     * @param  string $separator html code
     *
     * @return str
     */
    public function toHtml($separator = '<br/>', $show_heading = true)
    {
        $html = [];

        if ('App\Customer' == $this->addressable_type && $show_heading)
            $html [] = '<strong class="pull-right">' . strtoupper($this->address_type) . '</strong>';

        if(config('system_settings.show_address_title'))
            $html [] = $this->address_title;

        if(strlen($this->address_line_1))
            $html [] = $this->address_line_1;

        if(strlen($this->address_line_2))
            $html [] = $this->address_line_2;

        if(strlen($this->city))
            $html []= $this->city . ', ';

        if(strlen($this->state_id) || $this->zip_code)
            $html []= sprintf('%s %s', e($this->state_id ? $this->state->name : ''), e($this->zip_code));

        if(config('system_settings.address_show_country') && $this->country)
            $html []= e($this->country->name);

        if(strlen($this->phone))
            $html [] = '<abbr title="' . trans('app.phone') . '">P:</abbr> ' . e($this->phone);

        $addressStr = implode($separator, $html);

        $return = '<address>'.$addressStr.'</address>';

        return $return;
    }

    /**
     * Return a "string formatted" version of the address
     */
    public function toString($title = False)
    {
        $str = [];

        if($title || config('system_settings.show_address_title'))
            $str [] = $this->address_title;

        if(strlen($this->address_line_1))
            $str [] = $this->address_line_1;

        if(strlen($this->address_line_2))
            $str [] = $this->address_line_2;

        if(strlen($this->city))
            $str []= $this->city . ', ';

        if(strlen($this->state_id) || $this->zip_code)
            $str []= sprintf('%s %s', e($this->state_id ? $this->state->name : ''), e($this->zip_code));

        // if(strlen($this->city)){
        //     $state_name = $this->state ? $this->state->name : '';
        //     $str []= sprintf('%s, %s %s', $this->city, $state_name, $this->zip_code);
        // }

        if(config('system_settings.address_show_country') && $this->country)
            $str []= $this->country->name;

        if(strlen($this->phone))
            $str [] =  trans('app.phone') . ': ' . e($this->phone);

        return implode(', ', $str);
    }

    /**
     * Get address as array
     *
     * @return array|null
     */
    public function toArray()
    {
        $address = [];
        $address ['address_type'] = $this->address_type;
        $address['address_title'] = $this->address_title;
        $address['address_line_1'] = $this->address_line_1;
        $address['address_line_2'] = $this->address_line_2;
        $address['city'] = $this->city;

        if($this->state)
            $address['state'] = $this->state->name;

        $address['zip_code'] = $this->zip_code;

        if($this->country)
            $address['country'] = $this->country->name;

        $address['phone'] = $this->phone;

        if($this->latitude && $this->longitude){
            $address['latitude'] = $this->latitude;
            $address['longitude'] = $this->longitude;
        }

        $address = array_filter($address);

        if (empty($address)) return;

        return $address;
    }
}
