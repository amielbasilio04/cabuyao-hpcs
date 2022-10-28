@component('mail::message')
# Patient Reserved a Schedule

Patient {{$patient->name}} has reserved a schedule. Click the button below. 

@component('mail::button', ['url' => $url, 'color' => 'success'])
    Redirect
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent