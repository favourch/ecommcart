@component('mail::message')
#{{ trans('notifications.customer_registered.greeting', ['customer' => $customer->getName()]) }}

{{ trans('notifications.customer_registered.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.customer_registered.action.color')])
{{ trans('notifications.customer_registered.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
