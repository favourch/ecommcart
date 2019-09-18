<fieldset>
	<legend>{{ trans('app.billing_info') }}</legend>
    <!-- Error Message / Stripe Threw Exception -->
    <div class="stripe-errors alert alert-danger hide">{{ trans('messages.trouble_validating_card') }}</div>
    <div class="form-group has-feedback">
        {!! Form::text('name', isset($billable) ? $billable->card_holder_name : Null, ['class' => 'form-control input-lg', 'data-stripe' => 'name', 'placeholder' => trans('app.placeholder.card_holders_name'), 'required']) !!}
        <i class="glyphicon glyphicon-user form-control-feedback"></i>
        <div class="help-block with-errors"></div>
    </div>

    <div class="row">
	    <div class="col-md-8 nopadding-right">
		    <div class="form-group has-feedback">
		    	<input type="text" value="{{ old('number') }}" class="form-control input-lg" data-stripe="number" placeholder="{{ isset($billable) && $billable->card_last_four ? '************' . $billable->card_last_four : trans('app.placeholder.card_number') }}" required>
		        @if(isset($billable))
			        <i class="fa fa-cc-{{ strtolower($billable->card_brand) }} form-control-feedback"></i>
				@else
			        <i class="glyphicon glyphicon-credit-card form-control-feedback"></i>
				@endif
		        <div class="help-block with-errors"></div>
		    </div>
	    </div>

	    <div class="col-md-4 nopadding-left">
		    <div class="form-group has-feedback">
                <input type="text" class='form-control input-lg' placeholder="@lang('app.placeholder.cvc')" data-stripe='cvc' required/>
		        <i class="glyphicon glyphicon-lock form-control-feedback"></i>
		        <div class="help-block with-errors"></div>
		    </div>
	    </div>
    </div>

    <div class="row">
	    <div class="col-md-6 nopadding-right">
		    <div class="form-group has-feedback">
		    	{{ Form::selectMonth('exp-month', Null, ['id' =>'exp-month', 'class' => 'form-control input-lg', 'data-stripe' => 'exp-month', 'placeholder' => trans('app.placeholder.exp_month'), 'required'], '%m') }}
		        <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
		        <div class="help-block with-errors"></div>
		    </div>
	    </div>

	    <div class="col-md-6 nopadding-left">
		    <div class="form-group has-feedback">
		    	{{ Form::selectYear('exp-year', date('Y'), date('Y') + 10, Null, ['id' =>'exp-year', 'class' => 'form-control input-lg', 'data-stripe' => 'exp-year', 'placeholder' => trans('app.placeholder.exp_year'), 'required']) }}
		        <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
		        <div class="help-block with-errors"></div>
		    </div>
	    </div>
    </div>

	<span class="text-info">
		<strong><i class="icon fa fa-info-circle"></i></strong>
		{{ trans('messages.we_dont_save_card_info') }}
	</span>
	<span class="spacer20"></span>
</fieldset>