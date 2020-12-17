@component('mail::message')
# Ticket #{{ $user->id }}

@component('mail::table')
| Name       | Email         |  Phone   |   Ticket Price   |
| ------------- |:-------------:| --------:|
| {{ $user->name }}     | {{ $user->email }}      | {{ $user->phone }}    |   {{ $user->ticket_price }}
@endcomponent

@if(!$user->from_mansoura_university)
@component('mail::panel')
Event Location : ITI - Information Technology Institute (Mansoura University) <br>
<time>
    <span>DEC 23 – DEC 24</span>
    <span>10:00 AM to 04:30 PM</span>
</time>
<hr>
You can Pay via vodafone cash <br>
phone number : 123456789
@endcomponent
@endif

Thanks,<br>
Bio Code Team
@endcomponent