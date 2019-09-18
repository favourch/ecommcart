@component('mail::message')
#{{ trans('notifications.shop_updated.greeting', ['merchant' => $shop->owner->getName()]) }}

{{ trans('notifications.shop_updated.message', ['shop_name' => $shop->name]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.shop_updated.action.color')])
{{ trans('notifications.shop_updated.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
