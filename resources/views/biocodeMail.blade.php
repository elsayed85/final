{{-- <h1>
    Thank you <strong>{{ $el->name }}</strong> for filling out the event form. Get Your Guied.
    Keep the ID that you will receive because attendance will be based on the serial number.♥️ <br>
    <strong>your id is {{ $el->id }}</strong>
</h1>
 --}}

 @php
    if(isset($message)){
        var_dump($message);
    }else{
        echo "not found";
    }
 @endphp
