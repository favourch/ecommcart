<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{

    private $attributeValue;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // composite_unique
        Validator::extend('composite_unique', function ($attribute, $value, $parameters, $validator){
                // Set the attribute value to use in feedback message
                $this->attributeValue = $value;

                // Clean the parameters
                $parameters = array_map( 'trim', $parameters );

                // Grab the table name and remove the it from parameters
                $table = array_shift( $parameters );

                // Check if the last parameter is a number and if so then assume the number is the exception ID
                $exceptionId = (bool) preg_match( '/^\d+$/', end($parameters) ) ? array_pop( $parameters ) : null ;

                // Now start building the conditional array.
                $wheres = $exceptionId ?
                        [
                            ['id', '!=', $exceptionId]
                        ] : [];

                // Add current key-value in conditional array
                $wheres[] = [ $attribute, '=', $value ];

                // iterates over the other given parameters and build the wheres array
                while ( $field = array_shift( $parameters ) )
                {
                    if ($field == $attribute) continue; //Check if the attribute passed in the parameter

                    $t = explode(':', $field); //extract parameters that have value

                    // Check if the parameter passed with value
                    if(isset($t[1])){
                        $t[1] = $t[1] != '' ? $t[1] : null; // IF the padded value is empty then assign NULL
                        $wheres[] = [ $t[0], '=', $t[1] ];  // Passed with value, so assign the value to the field
                    }
                    else{
                        $wheres[] = [ $field, '=', \Request::get( $field ) ];  // Passed field name only, so find the value in form request
                    }
                }

                // Our conditional array is ready and now query the table with all the conditions
                $result = \DB::table( $table )->where( $wheres )->first();

                //Return FLASE if any record found
                return empty( $result );
            }
        );

        Validator::replacer('composite_unique', function ($message, $attribute, $rule, $parameters)
        {
            return str_replace(':value', $this->attributeValue, $message);
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
