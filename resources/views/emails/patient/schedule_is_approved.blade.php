@component('mail::message')
# Schedule Request Update
@if($date_time->status == 2)
        Thank you for waiting. Unfortunatetly your schedule request has been declined by our administrator.
@endif

@if($date_time->status == 1)

         Thank you for waiting. Your schedule request has been approved. You can now check your schedule from your dashboard.

@endif

@component('mail::button', ['url' => $url, 'color' => 'success'])
    Redirect
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent