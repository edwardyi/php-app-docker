@component('mail::message')

<strong>Thanks you for your message</strong>
<strong>Name</strong> 
{{$data['name']}}
<strong>Email</strong> 
{{$data['email']}}
<strong>Message</strong> 
{{$data['message']}}

@endcomponent
