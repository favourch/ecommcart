<script type="text/javascript">
	/*************************************
	*** Initialise application plugins ***
	**************************************/
	// var jq214 = jQuery.noConflict(true);
	;(function($, window, document) {
		// console.log($().jquery);
		$(".ajax-modal-btn").hide(); // hide the ajax functional button untill the page load completely

		$('img').on('error', function(){
		    $(this).hide();
		});

        // Activate the tab if the url has any #hash
        $('.nav a').on('show.bs.tab', function (e) {
            window.location = $(this).attr('href');
        });
        $(function () {
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        });

		$(document).ready(function(){
			// show the ajax functional button when the page loaded completely and
			// Disable mouse right click on modal button
			$('.ajax-modal-btn').bind('contextmenu', function(e) {
			    return false;
			}).show();

		    // Initialise all plugins
		    initDatatables();
		    initAppPlugins();
		    initMassActions();

		    // Support for AJAX loaded modal window.
		    $('body').on('click', '.ajax-modal-btn', function(e) {
				e.preventDefault();

				apply_busy_filter();

				var url = $(this).data('link');
				// var url = $(this).attr('href');
				if (url.indexOf('#') == 0) {
					$(url).modal('open');
				}
		      	else {
			        $.get(url, function(data) {

			        	remove_busy_filter();

						//Load modal data
						$('#myDynamicModal').modal().html(data);

						//Initialize application plugins after ajax load the content
						if (typeof initAppPlugins == 'function') {
							initAppPlugins();
						}
			        })
			        .done(function()
			        {
			          $('.modal-body input:text:visible:first').focus();
			        })
			        .fail(function(response)
			        {
				        if (401 === response.status){
				            window.location = "{{ route('login') }}";
				        }
				        else{
				        	console.log("{{ trans('responses.error') }}");
				        }
			        });
		      	}
		    });

		    // Confirmation for actions
		    $('body').on('click', '.confirm', function(e) {
			    e.preventDefault();

			    var form = this.closest("form");
			    var url = $(this).attr("href");

			    $.confirm({
			        title: "{{ trans('app.confirmation') }}",
			        content: "{{ trans('app.are_you_sure') }}",
			        type: 'red',
			        icon: 'fa fa-question-circle',
			        animation: 'scale',
			        closeAnimation: 'scale',
			        opacity: 0.5,
			        buttons: {
			          'confirm': {
			              text: '{{ trans('app.proceed') }}',
			              keys: ['enter'],
			              btnClass: 'btn-red',
			              action: function () {
				            apply_busy_filter();

			                if (typeof url != 'undefined') {
			                  	location.href = url;
			                }else if(form != null){
			                  	form.submit();
			                  	notie.alert(4, "{{ trans('messages.confirmed') }}", 3);
			                }
			                return true;
			              }
			          },
			          'cancel': {
			              text: '{{ trans('app.cancel') }}',
			              action: function () {
			                notie.alert(2, "{{ trans('messages.canceled') }}", 3);
			              }
			          },
			        }
			    });
			});

		    // Mark all Notifications As Read.
			$('#notifications-dropdown').on('click', function (e) {
			    var url = "{{ route('admin.notifications.markAllAsRead') }}";

		        $.get(url, function(data) {}).done(function()
		        {
		          $('#notifications-dropdown').find('span.label').text('');
		        });
		    });

		    // Update announcement read timestamp.
			$('#announcement-dropdown').on('click', function (e) {
			    var url = "{{ route('admin.setting.announcement.read') }}";

		        $.get(url, function(data) {}).done(function()
		        {
		          $('#announcement-dropdown').find('span.label').text('');
		        });
		    });
		});
	}(window.jQuery, window, document));

	//DataTables
	function initDatatables()
	{
		$('#all-product-table').DataTable({
		  	"aaSorting": [],
		    "iDisplayLength": {{ getPaginationValue() }},
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('admin.catalog.product.getMore') }}",
			"columns": [
	            { 'data': 'name', 'name': 'name' },
	            { 'data': 'gtin', 'name': 'gtin' },
	            { 'data': 'model_number', 'name': 'model_number' },
	            { 'data': 'category', 'name': 'category', 'orderable': false, 'searchable': false },
	            { 'data': 'inventories_count', 'name': 'inventories_count', 'searchable': false },
	            { 'data': 'option', 'name': 'option', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false }
	        ],
		    "oLanguage": {
		        "sInfo": "_START_ to _END_ of _TOTAL_ entries",
		        "sLengthMenu": "Show _MENU_",
		        "sSearch": "",
		        "sEmptyTable": "No data found!",
		        "oPaginate": {
		          "sNext": '<i class="fa fa-hand-o-right"></i>',
		          "sPrevious": '<i class="fa fa-hand-o-left"></i>',
		        },
		    },
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [ -1 ]
		     }],
			"lengthMenu": [
				[10, 25, 50, -1],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],     // page length options
		    dom: 'Bfrtip',
		    buttons: [
		        	'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
		    	]
	    });

		$('#all-customer-table').DataTable({
		  	"aaSorting": [],
		    "iDisplayLength": {{ getPaginationValue() }},
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('admin.admin.customer.getMore') }}",
			"columns": [
	            { 'data': 'nice_name', 'name': 'nice_name' },
	            { 'data': 'name', 'name': 'name' },
	            { 'data': 'email', 'name': 'email' },
	            { 'data': 'orders_count', 'name': 'orders_count', 'searchable': false },
	            { 'data': 'option', 'name': 'option', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false }
	        ],
		    "oLanguage": {
		        "sInfo": "_START_ to _END_ of _TOTAL_ entries",
		        "sLengthMenu": "Show _MENU_",
		        "sSearch": "",
		        "sEmptyTable": "No data found!",
		        "oPaginate": {
		          "sNext": '<i class="fa fa-hand-o-right"></i>',
		          "sPrevious": '<i class="fa fa-hand-o-left"></i>',
		        },
		    },
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [ -1 ]
		     }],
			"lengthMenu": [
				[10, 25, 50, -1],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],     // page length options
		    dom: 'Bfrtip',
		    buttons: [
		        	'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
		    	]
	    });

	  	$(".table-2nd-short").DataTable({
		    "iDisplayLength": {{ getPaginationValue() }},
		    "aaSorting": [[ 1, "asc" ]],
		    "oLanguage": {
		        "sInfo": "_START_ to _END_ of _TOTAL_ entries",
		        "sLengthMenu": "Show _MENU_",
		        "sSearch": "",
		        "sEmptyTable": "No data found!",
		        "oPaginate": {
		          "sNext": '<i class="fa fa-hand-o-right"></i>',
		          "sPrevious": '<i class="fa fa-hand-o-left"></i>',
		        }
		    },
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [ 0,-1 ]
		     }],
			"lengthMenu": [
				[10, 25, 50, -1],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],     // page length options
		    dom: 'Bfrtip',
		    buttons: [
		        	'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
		    	]
	  	});

	  	$(".table-option").DataTable({
		    "iDisplayLength": {{ getPaginationValue() }},
		    "oLanguage": {
		        "sInfo": "_START_ to _END_ of _TOTAL_ entries",
		        "sLengthMenu": "Show _MENU_",
		        "sSearch": "",
		        "sEmptyTable": "No data found!",
		        "oPaginate": {
		          "sNext": '<i class="fa fa-hand-o-right"></i>',
		          "sPrevious": '<i class="fa fa-hand-o-left"></i>',
		        },
		    },
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [ -1 ]
		     }],
		    dom: 'Bfrtip',
		    buttons: [
		          'copy', 'csv', 'excel', 'pdf', 'print'
		      	]
	  	});

	  	$(".table-no-sort").DataTable({
		  	// "bSort": false,
		  	"aaSorting": [],
		    "iDisplayLength": {{ getPaginationValue() }},
		    "oLanguage": {
		        "sInfo": "_START_ to _END_ of _TOTAL_ entries",
		        "sLengthMenu": "Show _MENU_",
		        "sSearch": "",
		        "sEmptyTable": "No data found!",
		        "oPaginate": {
		          "sNext": '<i class="fa fa-hand-o-right"></i>',
		          "sPrevious": '<i class="fa fa-hand-o-left"></i>',
		        },
		    },
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [ -1 ]
		     }],
		    dom: 'Bfrtip',
		    buttons: [
		          'copy', 'csv', 'excel', 'pdf', 'print'
		      ]
	  	});

	  	$(".table-desc").DataTable({
		    "iDisplayLength": {{ getPaginationValue() }},
		    "aaSorting": [[ 0, "desc" ]],
		    "oLanguage": {
		        "sInfo": "_START_ to _END_ of _TOTAL_ entries",
		        "sLengthMenu": "Show _MENU_",
		        "sSearch": "",
		        "sEmptyTable": "No data found!",
		        "oPaginate": {
		          "sNext": '<i class="fa fa-hand-o-right"></i>',
		          "sPrevious": '<i class="fa fa-hand-o-left"></i>',
		        },
		    },
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [ -1 ]
		     }],
		    dom: 'Bfrtip',
		    buttons: [
		          'copy', 'csv', 'excel', 'pdf', 'print'
		      	]
	  	});

	  	$('.table-no-option').DataTable({
		    "sLength": "",
		    "paging": true,
		    "lengthChange": false,
		    "searching": false,
		    "ordering": false,
		    "info": true,
		    "autoWidth": false
	  	});

	  	$(".dataTables_length select").addClass('select2-normal'); //Make the data-table length dropdown like select 2
	  	$(".dt-buttons > .btn").addClass('btn-sm'); //Make the data-table option buttins smaller
	}
	//END DataTables

	//App plugins
	function initAppPlugins()
	{
		$.ajaxSetup ({
		    cache: false,
		    headers: {
		        'X-CSRF-TOKEN': "{{ csrf_token() }}"
		    }
	  	});

		// Icon picker
		$('.iconpicker-input').iconpicker();

		//Initialize Select2 Elements
		$(".select2").not(".dataTables_length .select2").select2();

		$(".select2-normal").select2({
			placeholder: "{{ trans('app.placeholder.select') }}",
			minimumResultsForSearch: -1,
		});

		$(".select2-tag").select2({
		    placeholder: "{{ trans('app.placeholder.tags') }}",
		    tags: true,
		    allowClear: true,
		    tokenSeparators: [',', ';'],
		});

		$(".select2-set_attribute").select2({
		    placeholder: "{{ trans('app.placeholder.attribute_values') }}",
		    minimumResultsForSearch: -1,
		    tags: true,
		    allowClear: true,
		    tokenSeparators: [',', ';'],
		});

		$(".select2-attribute_value-attribute").select2({
		    placeholder: "{{ trans('app.placeholder.select') }}",
		    minimumResultsForSearch: -1,
		}).on("change", function(e){
		    var dataString = 'id=' + $(this).val();
		    $.ajax({
		        type: "get",
		        url : "{{ route('admin.ajax.getParrentAttributeType') }}",
		        data : dataString,
		        datatype: 'JSON',
		        success : function(attribute_type)
		        {
		          if (attribute_type == {{\App\Attribute::TYPE_COLOR}})
		          {
		            $('#color-option').removeClass('hidden').addClass('show');
		          }
		          else
		          {
		            $('#color-option').removeClass('show').addClass('hidden');
		          }
		        }
		    },"html");
		});

		// $(".select2-roles").select2({
		//  {{--   placeholder: "{{ trans('app.placeholder.roles') }}" --}}
		// });

		//Country
		$("#country_id").change(
		    function()
		    {
		      $("#state_id").empty().trigger('change'); //Reset the state dropdown
		      var ID = $("#country_id").select2('data')[0].id;
		      var url = "{{ route('ajax.getCountryStates') }}"

		      $.ajax({
		          delay: 250,
		          data: "id="+ID,
		          url: url,
		          success: function(result){
		            var data = [];
		            if(result.length !== 0){
		              data = $.map(result, function(val, id) {
		                  return { id: id, text: val };
		              })
		            }

		            $("#state_id").select2({
		              allowClear: true,
		              tags: true,
		              placeholder: "{{ trans('app.placeholder.state') }}",
		              data: data,
		              sortResults: function(results, container, query) {
		                  if (query.term) {
		                      return results.sort();
		                  }
		                  return results;
		              }
		            });
		          }
		      });
		    }
		);

		$(".select2-categories").select2({
		    placeholder: "{{ trans('app.placeholder.category_sub_groups') }}"
		});

		$(".select2-multi").select2({
		    maximumSelectionLength: 2,
		});

		$(".select2").not(".dataTables_length .select2").css('width', '100%');

	  	//product Seach
		$('#searchProduct').on('keyup', function(e){
		  	var showResult = $("#productFounds");
		  	var q = $(this).val();
		  	showResult.html('');
		  	if(q.length < 3){
			  	showResult.html('<span class="lead indent50">{{ trans('validation.min.string', ['attribute' => trans('app.form.search'), 'min' => '3' ]) }}</span>');
			  	return;
		  	}

		  	showResult.html('<span class="lead indent50">{{trans('responses.searching')}}</span>');
			$.ajax({
				data: "q="+q,
		      	url : "{{ route('search.product') }}",
		      	success: function(results){
				  	showResult.html(results);
		      	}
	        });
		});
		//End product Seach

		//Customer Seach
		$('.searchCustomer').select2({
		    ajax: {
		      url : "{{ route('search.customer') }}",
		      dataType: 'json',
		      processResults: function (data) {
		        return {
		          results: data
		        };
		      },
		      cache: true
		    },
		    placeholder: "{{ trans('app.placeholder.search_customer') }}",
		});
		//End Customer Seach

		/* bootstrap-select */
		$(".selectpicker").selectpicker();

		//Initialize validator
		$('#form, form[data-toggle="validator"]').validator();

		//Initialize summernote text editor
		$('.summernote').summernote({
		    placeholder: "{{ trans('app.placeholder.start_here') }}",
		    toolbar: [
		      ['style', ['style']],
		      ['font', ['bold', 'italic', 'underline', 'clear']],
		      ['para', ['ul', 'ol', 'paragraph']],
		      ['table', ['table']],
		      ['color', ['color']],
		      ['insert', ['link', 'picture', 'video']],
		      ["view", ["codeview"]],
		    ],
		});
		$('.summernote-min').summernote({
		    placeholder: "{{ trans('app.placeholder.start_here') }}",
		    toolbar: [
		      ['font', ['bold', 'italic', 'underline', 'clear']],
		      ['para', ['ul', 'ol', 'paragraph']],
		      ['table', ['table']],
		    ],
		});
		$('.summernote-without-toolbar').summernote({
		    placeholder: "{{ trans('app.placeholder.start_here') }}",
		    toolbar: [],
		});
		$('.summernote-long').summernote({
		    placeholder: "{{ trans('app.placeholder.start_here') }}",
		    toolbar: [
		      ['style', ['style']],
		      ['font', ['bold', 'italic', 'underline', 'clear']],
		      ['fontname', ['fontname']],
		      ['color', ['color']],
		      ['para', ['ul', 'ol', 'paragraph']],
		      ['height', ['height']],
		      ['table', ['table']],
		      ['insert', ['link', 'picture', 'video', 'hr']],
		      ['view', ['codeview']],
		    ],
		    // codemirror: {
		    //   theme: 'monokai'
		    // },
		    // onImageUpload: function(files) {
		    //   url = $(this).data('upload'); //path is defined as data attribute for  textarea
		    //   console.log(url);
		    //   console.log(' not');
		    //   // sendFile(files[0], url, $(this));
		    // }
		});

		/*
		* Summernote hack
		*/
		// Keep the dynamic modal open after close the insert media in summernote field
		$(document).on('hidden.bs.modal', '.modal', function () {
		    $('.modal:visible').length && $(document.body).addClass('modal-open');
		});

		$('.modal-dismiss').click(function (event) {
		    $('.note-modal').modal('hide');
		});

	  	//Datemask dd/mm/yyyy
	  	// $(".datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});

	  	//Datemask2 mm/dd/yyyy
	  	// $(".datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

	  	//Money Euro
	  	// $("[data-mask]").inputmask();

	  	//Date range picker
	  	// $('#reservation').daterangepicker();

	  	//Date range picker with time picker
	  	// $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

	  	//Date range as a button
	  	//Timepicker
	  	// $(".timepicker").timepicker({
	  	//   showInputs: false
	  	// });

		//Datepicker
		$(".datepicker").datepicker({
		    format: 'yyyy-mm-dd'
		});
		//DateTimepicker
		$(".datetimepicker").datetimepicker({
		    format: 'YYYY-MM-DD hh:mm a',
	  	    icons:{
	  	        time: 'glyphicon glyphicon-time',
	  	        date: 'glyphicon glyphicon-calendar',
	  	        previous: 'glyphicon glyphicon-chevron-left',
	  	        next: 'glyphicon glyphicon-chevron-right',
	  	        today: 'glyphicon glyphicon-screenshot',
	  	        up: 'glyphicon glyphicon-chevron-up',
	  	        down: 'glyphicon glyphicon-chevron-down',
	  	        clear: 'glyphicon glyphicon-trash',
	  	        close: 'glyphicon glyphicon-remove'
	  	    }
		});

		//Colorpicker
		$(".my-colorpicker1").colorpicker();
		//color picker with addon
		$(".my-colorpicker2").colorpicker();

	  	// $('#daterange-btn').daterangepicker(
	  	//     {
	  	//       ranges: {
	  	//         'Today': [moment(), moment()],
	  	//         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	  	//         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	  	//         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	  	//         'This Month': [moment().startOf('month'), moment().endOf('month')],
	  	//         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  	//       },
	  	//       startDate: moment().subtract(29, 'days'),
	  	//       endDate: moment()
	  	//     },
	  	//     function (start, end) {
	  	//       $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	  	//     }
	  	// );

		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].icheck, input[type="radio"].icheck').iCheck({
		    checkboxClass: 'icheckbox_flat-pink',
		    radioClass: 'iradio_flat-pink'
		});
	  	//iCheck line checkbox and radio
	  	$('.icheckbox_line').each(function(){
		    var self = $(this),
		    label = self.next(),
		    label_text = label.text();

		    label.remove();
		    self.iCheck({
		      checkboxClass: 'icheckbox_line-pink',
		      radioClass: 'iradio_line-pink',
		      insert: '<div class="icheck_line-icon form-control"></div>' + label_text
		    });
	  	});

	  	// Coupon form
	  	$('input#for_limited_customer').on('ifChecked', function () {
	    	$('#customers_field').removeClass('hidden').addClass('show');
	    	$('select#customer_list_field').attr('required', 'required');
	  	});
	  	$('input#for_limited_customer').on('ifUnchecked', function () {
	    	$('#customers_field').removeClass('show').addClass('hidden');
	    	$('select#customer_list_field').removeAttr('required');
	  	});

	  	$('input#for_limited_shipping_zones').on('ifChecked', function () {
	    	$('#zones_field').removeClass('hidden').addClass('show');
	    	$('select#zone_list_field').attr('required', 'required');
	  	});
	  	$('input#for_limited_shipping_zones').on('ifUnchecked', function () {
	    	$('#zones_field').removeClass('show').addClass('hidden');
	    	$('select#zone_list_field').removeAttr('required');
	  	});
	  	//END Coupon form

	  	//shipping zone
		$('input#rest_of_the_world').on('ifChecked', function () {
		    $('select#country_ids').removeAttr('required').attr('disabled', 'disabled');
		    $('select#country_ids').select2('val', '');
		});

		$('input#rest_of_the_world').on('ifUnchecked', function () {
		    $('select#country_ids').removeAttr('disabled').attr('required', 'required');
		});

	  	$('input#free_shipping_checkbox').on('ifChecked', function () {
	    	$('input#shipping_rate_amount').val(0.0).removeAttr('required').attr('disabled', 'disabled');
	  	});

	  	$('input#free_shipping_checkbox').on('ifUnchecked', function () {
	    	$('input#shipping_rate_amount').removeAttr('disabled').attr('required', 'required');
	  	});
	  	//END shipping zone

	  	//User Role form
	  	$("#user-role-status").change(function()
	  	{
	    	var temp = $("#user-role-status").select2('data')[0].text;
	    	var roleType = temp.toLowerCase();
		    var rows = $('table#tbl-permissions tr');
		    var platform = rows.filter('.platform-module');
		    var merchant = rows.filter('.merchant-module');

		    switch(roleType)
		    {
		      case 'platform':
		        platform.show();
		        merchant.hide();
		        merchant.find("input[type='checkbox']").iCheck('uncheck');
		        break;
		      case 'merchant':
		        platform.hide();
		        merchant.show();
		        platform.find("input[type='checkbox']").iCheck('uncheck');
		        break;
		      default:
		        platform.hide();
		        merchant.hide();
		        merchant.find("input[type='checkbox']").iCheck('uncheck');
		        platform.find("input[type='checkbox']").iCheck('uncheck');
		    }
		});

	  	$('input.role-module').on('ifChecked', function () {
	    	var selfId = $(this).attr('id');
	    	var childClass =  '.' + selfId + '-permission';
	    	$(childClass).iCheck('enable').iCheck('check');
	  	});

		$('input.role-module').on('ifUnchecked', function () {
			var selfId = $(this).attr('id');
			var childClass =  '.' + selfId + '-permission';
			$(childClass).iCheck('uncheck').iCheck('disable');
		});
	  	//END User Role form

	  	//Slug URL Maker
	  	$('.makeSlug').on('change', function(){
		    var slugstr = convertToSlug(this.value);
		    $('.slug').val(slugstr);
			// setTimeout(sample,2000)
		    verifyUniqueSlug();
	  	});

	  	$('.slug').on('change', function(){
	    	verifyUniqueSlug($(this).val());
	  	});

	  	function verifyUniqueSlug(slug = ''){
		  	var node = $("#slug");
		    var msg = "{{ trans('messages.slug_length') }}";

		  	if(slug == '')
		  		slug = node.val();

		  	if (slug.length >= 3){
		  		var route = "{{ Route::current()->getName() }}";

				if(route.match(/category/i)){
				    var tbl = 'categories';
					var url = '/category/';
				}
				else if(route.match(/inventory/i)){
				    var tbl = 'inventories';
					var url = 'product/';
				}
				else if(route.match(/page/i)){
				    var tbl = 'pages';
					var url = 'page/';
				}
				else if(route.match(/blog/i)){
				    var tbl = 'blogs';
					var url = 'blog/';
				}
				else{
				    var tbl = 'shops';
					var url = 'shop/';
				}

			    var check = getFromPHPHelper('verifyUniqueSlug', [slug, tbl]);
			    if(check == 'false'){
				    node.closest( ".form-group" ).addClass('has-error');
			    	msg = "{{ trans('messages.this_slug_taken') }}";
			    }
			    else if(check == 'true'){
				    node.closest( ".form-group" ).removeClass('has-error');
			    	msg = "{{ str_finish(config('app.url'), '/') }}" + url + slug;
			    }
		  	}

		    node.next( ".help-block" ).html(msg);
		  	return;
	  	}

	  	function convertToSlug(Text){
	    	return Text.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
	  	}
	  	//END Slug URL Maker

	  	//Popover
	  	$('[data-toggle="popover"]').popover({
	    	html: 'true',
	  	});

	  	$('[data-toggle="popover"]').on('click', function(){
	    	$('[data-toggle="popover"]').not(this).popover('hide');
	  	});

	  	$(document).on("click", ".popover-submit-btn", function() {
	    	$('[data-toggle="popover"]').popover('hide');
	  	});
	  	//END Popover

	  	if( $('#uploadBtn').length ){
		    document.getElementById("uploadBtn").onchange = function () {
		      document.getElementById("uploadFile").value = this.value;
		    };
	  	}
	  	if( $('#uploadBtn1').length ){
		    document.getElementById("uploadBtn1").onchange = function () {
		      document.getElementById("uploadFile1").value = this.value;
		    };
	  	}

		//SEARCH OPTIONS
		var $search_rows = $('#search_table tr');
		$('#search_this').keyup(function() {
		    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		    $search_rows.show().filter(function() {
		        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		        return !~text.indexOf(val);
		    }).hide();
	  	});
	  	//END SEARCH OPTIONS

		//Random code string maker
		/**
		* generate Code
		*/
		$( '.generate-code' ).on( "click", function( event ){
		    var id = $( event.target ).attr('id');
		    var func = 'generateCouponCode';

		    switch(id){
		      case 'gc-pin-number':
		        func = 'generatePinCode';
		        break;
		      case 'gc-serial-number':
		        func = 'generateSerialNumber';
		        break;
		      default:
		        func = 'generateCouponCode';
		    }

		    var couponCode = getFromPHPHelper(func);
		    $('#'+id).closest( ".code-field" ).find( "input.code" ).val(couponCode);
		});
	  	//END Random code string maker

	  	// Toggle button
	  	$('.btn-toggle').on("click", function(e){
			e.preventDefault();
			var node = $( this );

	      	if(node.hasClass('toggle-confirm')){
	      		return new Promise(function(resolve, reject) {
		            $.confirm({
		                title: "{{ trans('app.confirmation') }}",
		                content: "{{ trans('app.are_you_sure') }}",
		                type: 'red',
		                buttons: {
				            'confirm': {
				                text: '{{ trans('app.proceed') }}',
				                keys: ['enter'],
				                btnClass: 'btn-red',
				                action: function () {
				                	notie.alert(4, "{{ trans('messages.confirmed') }}", 2);
							    	proceedToggleActionFor(node);
			                	}
			            	},
			            	'cancel': {
			                	text: '{{ trans('app.cancel') }}',
			                	action: function () {
					            	node.toggleClass('active');
		                    		notie.alert(2, "{{ trans('messages.canceled') }}", 2);
			                	}
			            	},
	                	}
	            	});
	        	});
	      	}
	      	proceedToggleActionFor(node);
	  	});

	  	function proceedToggleActionFor(node){
	      	$.ajax({
	          	url: node.attr('href'),
	          	type: 'POST',
	          	data: {
	              	"_token": "{{ csrf_token() }}",
	              	"_method": "PUT",
	          	},
	          	success: function (data) {
		            if (data == 'success'){
		              	notie.alert(1, "{{ trans('responses.success') }}", 2);
		            }
		            else{
		              	notie.alert(3, "{{ trans('responses.failed') }}", 2);
		              	node.toggleClass('active');
		            }
	          	},
	          	error: function (data) {
		            if (data.status == 403){
		              	notie.alert(2, "{{ trans('responses.denied') }}", 2);
		            }
		            else if (data.status == 444){
		              notie.alert(2, "{{ trans('messages.demo_restriction') }}", 5);
		            }
		            else{
		            	notie.alert(3, "{{ trans('responses.error') }}", 2);
		            }
		            node.toggleClass('active');
	          	}
	      	});
	  	}
	  	// END Toggle button

		// Toggle Congiguration widgets settings
	  	$('.toggle-widget').on("click", function(e){
			e.preventDefault();
			var node = $(this);
		    var box = $(this).closest(".box");

	      	if(node.hasClass('toggle-confirm')){
	      		return new Promise(function(resolve, reject) {
		            $.confirm({
		                title: "{{ trans('app.confirmation') }}",
		                content: "{{ trans('app.are_you_sure') }}",
		                type: 'red',
		                buttons: {
				            'confirm': {
				                text: '{{ trans('app.proceed') }}',
				                keys: ['enter'],
				                btnClass: 'btn-red',
				                action: function () {
				                	notie.alert(4, "{{ trans('messages.confirmed') }}", 2);
							    	proceedToggleActionFor(node);

							    	// Remove the removable box from UI
								    if(box.length == 1 && box.hasClass('removable'))
					                	box.remove();
			                	}
			            	},
			            	'cancel': {
			                	text: '{{ trans('app.cancel') }}',
			                	action: function () {
		                    		notie.alert(2, "{{ trans('messages.canceled') }}", 2);
			                	}
			            	},
	                	}
	            	});
	        	});
	      	}

	      	proceedToggleActionFor(node);

	    	// Remove the removable box from UI
		    if(box.length == 1 && box.hasClass('removable'))
            	box.remove();
	  	});
		//End

	  	//Ajax Form Submit
	  	$('.ajax-submit-btn').on("click", function(e){
	      	return;
	  	});

	  	$('.ajax-form').submit(function(e){
	      	e.preventDefault();
	      	//Return false and abort the action if the form validation failed
	      	if($(this).find('input[type=submit]').hasClass('disabled')){
	       		notie.alert(3, "{{ trans('responses.form_validation_failed') }}", 5);
	        	return;
	      	}

			apply_busy_filter();

	      	var action = this.action;
	      	var data = $( this ).serialize();
	      	$.ajax({
		        url: action,
		        type: 'POST',
		        data: data,
		        success: function (data) {
		            $('#myDynamicModal').modal('hide');
		            remove_busy_filter();

		            if (data == 'success'){
		              	notie.alert(1, "{{ trans('responses.success') }}", 3);
		            }
		            else{
		            	notie.alert(3, "{{ trans('responses.failed') }}", 3);
		              	node.toggleClass('active');
		            }
		        },
		        error: function (data) {
		            $('#myDynamicModal').modal('hide');
		            remove_busy_filter();
		            if (data.status == 403){
		              notie.alert(2, "{{ trans('responses.denied') }}", 3);
		            }
		            else if (data.status == 444){
		              notie.alert(2, "{{ trans('messages.demo_restriction') }}", 5);
		            }
		            else{
		              	notie.alert(3, "{{ trans('responses.error') }}", 3);
		            }
		            node.toggleClass('active');
		        }
	      	});
	  	});
	 	// END Ajax Form Submit

	  	// Offer Price form
	  	var errHelp = '<div class="help-block with-errors"></div>';
	  	$('#offer_price').keyup(
	      	function(){
	          	var offerPrice = this.value;
	          	if (offerPrice !== ""){
	              	$('#offer_start').attr('required', 'required');
	              	$('#offer_end').attr('required', 'required');
	          	}
	          	else{
	              	$('#offer_start').removeAttr('required');
	              	$('#offer_end').removeAttr('required');
	          	}
	      	}
	  	);
	  	//END Offer Price form

	  	// Collapsible fieldset
	  	$(function () {
			$('fieldset.collapsible > legend').prepend('<span class="btn-box-tool"><i class="fa fa-toggle-up"></i></span>');
			$('fieldset.collapsible > legend').click(function () {
			  	$(this).find('span i').toggleClass('fa-toggle-up fa-toggle-down');
			  	var $divs = $(this).siblings().toggle("slow");
			});
  		});
	  	//END collapsible fieldset
	}
	//END App plugins

	//Mass selection and action section
	function initMassActions()
	{
	  	//Enable iCheck plugin for checkboxes
	  	//iCheck for checkbox and radio inputs
	  	$('#massSelectArea input[type="checkbox"]').iCheck({
	    	checkboxClass: 'icheckbox_minimal-blue',
	    	radioClass: 'iradio_flat-blue'
	 	});

	  	//Enable check and uncheck all functionality
	  	$(".checkbox-toggle").click(function () {
		    var clicks = $(this).data('clicks');
		    if (clicks) {
		      $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
		      unCheckAll(); //Uncheck all checkboxes
		    } else {
		      $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
		      checkAll();  //Check all checkboxes
		    }
		    $(this).data("clicks", !clicks);
	  	});

	  	//Trigger the mass action functionality
	  	$('.massAction').on('click', function(e) {
		    e.preventDefault();

		    var doAfter = $(this).data('doafter');

		    var allVals = [];
		    $(".massCheck:checked").each(function() {
		        allVals.push($(this).attr('id'));
		    });

		    if(allVals.length <= 0){
		        notie.alert(3, "{{ trans('responses.select_some_item') }}", 2);
		    } else {
		        $.ajax({
		            url: $(this).attr('href'),
		            type: 'POST',
		            data: {
		                "_token": "{{ csrf_token() }}",
		                "ids": allVals,
		            },
		            success: function (data) {
		                if (data['success']) {
		                    notie.alert(1, data['success'], 2);
		                    switch(doAfter){
		                      case 'reload':
		                          window.location.reload();
		                          break;
		                      case 'remove':
		                          $(".massCheck:checked").each(function() {
		                            $(this).parents("tr").remove();
		                          });
		                          break;
		                      default:
		                        unCheckAll(); //Uncheck all checkboxes
		                    }
		                } else if (data['error']) {
		                    notie.alert(3, data['error'], 2);
		                } else {
		                    notie.alert(3, "{{ trans('responses.failed') }}", 2);
		                }
		            },
		            error: function (data) {
		              notie.alert(3, "{{ trans('responses.error') }}", 2);
		            }
		        });
		    }
	  	});
	}

	function checkAll(){
		$("#massSelectArea input[type='checkbox']").iCheck("check");
	}

	function unCheckAll(){
		$("#massSelectArea input[type='checkbox']").iCheck("uncheck");
	}
	//End Mass selection and action section

	function apply_busy_filter(dom = 'body') {
      	//Disable mouse pointer events and set the busy filter
      	jQuery(dom).css("pointer-events", "none");
		jQuery('.loader').show();
		jQuery(".wrapper").addClass('blur-filter');
	}
	function remove_busy_filter(dom = 'body') {
    	//Enable mouse pointer events and remove the busy filter
		jQuery(dom).css("pointer-events", "auto");
		jQuery(".wrapper").removeClass('blur-filter');
		jQuery('.loader').hide();
	}
	/*************************************
	*** END Initialise application plugins ***
	**************************************/

	 /*
	 * Get result from PHP helper functions
	 *
	 * @param  {str} funcName The PHP function name will be called
	 * @param  {mix} args     arguments need to pass into the PHP function
	 *
	 * @return {mix}
	 */
	function getFromPHPHelper(funcName, args = null)
	{
	    var url = "{{ route('helper.getFromPHPHelper') }}";
	    var result = 0;
	    $.ajax({
	        url: url,
	        data: "funcName="+ funcName + "&args=" + args,
	        async: false,
	        success: function(v){
	          result = v;
	        }
	    });
	    return result;
	}
</script>