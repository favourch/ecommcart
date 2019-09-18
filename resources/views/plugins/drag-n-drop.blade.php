<script type="text/javascript">
;(function($, window, document) {
	// var sorter = $('#sortable').rowSorter({
	$( document ).ready(function () {
		//Table row shorter
		RowSorter('#sortable', {
		    handler: '.sort-handler',
			onDrop: function(tbody, row, new_index, old_index)
		    {
		        var url = $("#sortable").data("action");
		        var max = Math.max(old_index, new_index);
		        var min = Math.min(old_index, new_index);
		        var order = {};
				$("#sortable tbody tr").each(function(index){
					if (index >= min && index <= max){
					  $( this ).find("span.order").text(index); //Update the reordered index
					  order[ $( this ).attr('id') ] = index;
					}
				});

		      	// Update the database using AJAX
		        $.post(url, order, function(theResponse, status){
			        notie.alert(1, "{{ trans('responses.reordered') }}", 2);
		        });
		    }
		});
	});
}(window.jQuery, window, document));
</script>