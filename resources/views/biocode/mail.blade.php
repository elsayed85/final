@component('mail::message')
# Your Ticket Id is  <b style="color: red">{{ $user->id }}</b>

@component('mail::table')
| Name | Phone | Ticket Price |
| ------------- |:-------------:| --------:|
| {{ $user->name }} | {{ $user->phone }} | {{ $user->ticket_price }}
@endcomponent

@component('mail::panel')
<p>Event Location : ITI (Mansoura University)</p>

@component('mail::button' , ['url' => "https://goo.gl/maps/dhucjAoNDr2oiGHy7"])
open in google map
@endcomponent

<hr>

<time>
    <span>DEC 23 – DEC 24</span>
    <br>
    <span>10:00 AM to 04:30 PM</span>
</time>

{{-- @if(!$user->from_mansoura_university)
<hr>
<p>
    You can Pay via vodafone cash to this number <br>
    phone number : <b>+20 103 066 9524</b><br>
    send screenshot of payment to our page <a href="https://www.facebook.com/BioCodeMansoura/">https://www.facebook.com/BioCodeMansoura/</a> or attach it to this email <b><a href="mailto:codebio2019@gmail.com">codebio2019@gmail.com</a></b>
</p>
<hr>

@endif --}}

<p style="color: red">
    لا تنسي البطاقة الشخصية لاتخاذ إجراءات الدخول للجامعه
</p>

@endcomponent

Thanks,<br>
Bio Code Team
@endcomponent
