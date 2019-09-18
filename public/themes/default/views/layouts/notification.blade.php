$(document).ready(function(){
    $.notify({
        // oprions
        icon: 'fa fa-{{$icon ?? 'paw'}}',
        title: "<strong>{{ $type == 'danger' ? 'Error' : $type }}:</strong> ",
        message: '{{ $message ?? '' }}'
    },{
    	// settings
        type: '{{ $type ?? 'info' }}',
        delay: 1500,
        placement: {
            from: "top",
            align: "right"
        },
    });
});
