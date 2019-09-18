@component('mail::message')
#{{ trans('notifications.shop_created.greeting', ['merchant' => $shop->owner->getName()]) }}

{{ trans('notifications.shop_created.message', ['shop_name' => $shop->name]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.shop_created.action.color')])
{{ trans('notifications.shop_created.action.text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
{{ get_platform_title() }}
@endcomponent
