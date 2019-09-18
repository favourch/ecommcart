@component('mail::message')
#{{ trans('notifications.shop_deleted.greeting') }}

{{ trans('notifications.shop_deleted.message') }}

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
