@component('mail::message')
#{{ trans('notifications.invoice_created.greeting', ['merchant' => $shop->owner->getName()]) }}

{{ trans('notifications.invoice_created.message', ['shop_name' => $shop->name]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.invoice_created.action.color')])
{{ trans('notifications.invoice_created.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
