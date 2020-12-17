@component('mail::message')
# Ticket #{{ $user->id }}

@component('mail::table')
| Name | Phone | Ticket Price |
| ------------- |:-------------:| --------:|
| {{ $user->name }} | {{ $user->phone }} | {{ $user->ticket_price }}
@endcomponent

@if(!$user->from_mansoura_university)
@component('mail::panel')
<p>Event Location : ITI - Information Technology Institute (Mansoura University)</p>

@component('mail:button' , ['url' => "https://goo.gl/maps/dhucjAoNDr2oiGHy7"])
open in google map
@endcomponent

<hr>
<time>
    <span>DEC 23 – DEC 24</span>
    <span>10:00 AM to 04:30 PM</span>
</time>
<hr>

<p>
    You can Pay via vodafone cash <br>
    phone number : <b>123456789</b>
</p>

@endcomponent

@endif

Thanks,<br>
Bio Code Team
@endcomponent
