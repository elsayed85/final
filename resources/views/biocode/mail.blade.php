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


@if(!$user->from_mansoura_university)
<div class="alert alert-success" role="alert">
    جميع التذاكر الان مجانيه - سيتم إرجاع الاموال لمن قام بدفع تمن التذكره
</div>

<div class="alert alert-danger" role="alert">
    لا تنسي إرفاق صورة البطاقة الشخصية من خلال الرد على على هذه الرساله او ارسال رسالة لنا على هذا الايميل  <a href="mailto:Bio.Code.19@gmail.com">Bio.Code.19@gmail.com</a>
    لاتخاذ إجرأت الدخول للجامعه
</div>
@endif

@endcomponent

Thanks,<br>
Bio Code Team
@endcomponent
