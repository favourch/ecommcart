<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    // Custom app validations
    // 'full_name_required'            => 'Your name is required',
    'composite_unique'              => 'The :attribute :value already exists.',
    'register_email_unique'         => 'This email address already has an account. Please try something else.',
    'role_type_required'            => 'Select role type.',
    'attribute_id_required'         => 'Select attribute.',
    'attribute_type_id_required'    => 'Select attribute type.',
    'attribute_code_required'       => 'The attribute code field is required.',
    'attribute_value_required'      => 'The attribute value field is required.',
    'category_list_required'        => 'Select at least one category.',
    'manufacturer_required'         => 'The manufacturer field is required.',
    'origin_required'               => 'The origin field is required.',
    'offer_start_required'          => 'When you have an offer price, the offer start date is required.',
    'offer_start_after'             => ' The promotion start time can\'t be a past time.',
    'offer_end_required'            => 'When you have an offer price, the offer end date is required.',
    'offer_end_after'               => ' The offer end time must be a time after the offer start time.',
    'variants_required'             => 'Variants required',
    'sku-unique'                    => 'The sku :value has already been taken. Try new one.',
    'sku-distinct'                  => 'Variant :attribute has a duplicate sku value.',
    'offer_price-numeric'           => ' is not a valid price value. The offer price must be a number.',
    'email_template_id_required'    => 'Email template is required.',
    // 'merchant_have_shop'            => 'This merchant have a shop.',
    'brand_logo_max'                => 'The brand logo may not be greater than :max kilobytes.',
    'brand_logo_mimes'              => 'The brand logo must be a file of type: :values.',
    'uploaded'                      => 'The file size exceeded the maximum upload limit on your server. Please check the php.ini file.',
    'avatar_required'               => 'Choose an avatar.',
    'subject_required_without'      => 'The subject is required if you dont use a template.',
    'message_required_without'      => 'The message is required if you dont use a template.',
    'template_id_required_without_all'=> 'Select a template or composer a new message.',
    'customer_required'             => 'Select a customer.',
    'reply_required_without' => 'The reply filed is required.',
    'template_id_required_without'=> 'Select a template is required when repling with template.',
    'shipping_zone_tax_id_required' => 'Select the tax profile for the zone',
    'shipping_zone_country_ids_required' => 'Select at least one country',
    'rest_of_the_world_composite_unique' => 'The rest of the world shipping zone already exists.',
    'something_went_wrong' => 'Something is not right. Please check and try again.',
    'shipping_rate_required_unless' => 'Give a shipping rate or select \'Free shipping\' option',
    'shipping_range_minimum_min' => 'Minimum range can\'t be negative value',
    'shipping_range_maximum_min' => 'Maximum range can\'t be less than minimum value',
    'csv_mimes'                => 'The :attribute must be a file of type csv.',
    'import_data_required' => 'The dataset is not valid to import. Please check your data and try again.',
    'do_action_required'    => 'You didn\'t provide the input.',
    'do_action_invalid'    => 'The given keyword/input is not valid.',
    'recaptcha'=>'Please ensure that you are a human!',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
