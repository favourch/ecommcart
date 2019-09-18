<script type="text/javascript">
;(function($, window, document) {
	$(document).ready(function() {
		var MaxInputs       = {{ config('system.inventory.max_key_features', 7) }}; //maximum extra input boxes allowed
		var InputsWrapper   = $("#DynamicInputsWrapper"); //Input boxes wrapper ID
		var AddButton       = $("#AddMoreField"); //Add button ID

		var FieldCount = InputsWrapper.children('.form-group').length; //initlal text box count

		//on add input button click
		$(AddButton).click(function (e) {
	        //max input box allowed
	        if(FieldCount <= MaxInputs) {
	            //add input box
	            $(InputsWrapper).append('<div class="form-group"><div class="input-group"><input type="text" name="key_features[]" class="form-control input-sm" id="field_'+ FieldCount +'" placeholder="{{ trans('app.placeholder.key_feature') }}"/><span class="input-group-addon"><i class="fa fa-times removeThisInputBox" data-toggle="tooltip" data-title="{{ trans('help.remove_input_field') }}"></i></span></div></div>');

	            FieldCount++; //text box added ncrement

	            // Delete the "add"-link if there is 3 fields.
	            if(FieldCount >= MaxInputs)
	                AddButton.attr('disabled', true);
	        }
	        return false;
		});

		$("body").on("click",".removeThisInputBox", function(e){ //user click on remove text
            $(this).closest('.form-group').remove(); //remove text box
            FieldCount--;
            AddButton.attr('disabled', false);
			return false;
		})
	});
}(window.jQuery, window, document));
</script>