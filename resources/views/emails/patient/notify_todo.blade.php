@component('mail::message')

Hi! What is your main focus today? You have a tasks that needs to be done. 
## My Task:
<ul>
@foreach($patient->todos as $todo)
<li>{{$todo->todo}}</li>
@endforeach
</ul>

@component('mail::button', ['url' => $url, 'color' => 'success'])
    Redirect
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent