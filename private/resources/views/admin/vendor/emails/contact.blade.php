@component('mail::message')
 Hi {{$content['name']}}  , <br>
{{$content['body']}}   
 {{ config('app.name') }}
@endcomponent
