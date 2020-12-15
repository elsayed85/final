<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>

<form method="POST" action="https://erada-soft.com/sdc/public/api/v1/biocode/messages" id="bicode_form">
    <div class="form">
       <div class="left">
           <div class="inputBx">
                <input type="text" id="username" placeholder="please Enter Your Name" name="name" required>
                <i class="fas fa-file-signature"></i>
                <div class="valid-message"></div>
           </div>
           <div class="inputBx">
                <input type="email" id="email" placeholder="Your E-mail" name="email" required>
                <i class="fas fa-envelope"></i>
                <div class="valid-message"></div>
            </div>
           <div class="inputBx">
                <input type="text" id="phone" placeholder="Your Number"  name="phone">
                <i class="fas fa-phone"></i>
                <div class="valid-message"></div>
            </div>

       </div>
       <div class="right">

            <div class="inputBx textarea">
                <i class="fas fa-hand-point-right"></i>
                <textarea name="message" placeholder="Leave Your Message Or Want To Add A new Field "></textarea>
           </div>
            <div class="inputBx .selector">
               <div class="multi_select_box">
                   <select class="multi_select w-100" multiple name="sessions">
                        <optgroup label="Day1">
                            <option value="Bio Informatics">Bio Informatics</option>
                            <option value="Flutter">Flutter</option>
                            <option value="Cyber Security">Cyber Security</option>
                        </optgroup>
                        <optgroup label="Day2">
                            <option value="Web Development">Web Development</option>
                            <option value="Machine Learning">Machine Learning</option>
                            <option value="Cyber Security">Cyber Security</option>
                        </optgroup>

                   </select>
               </div>
            </div>
            <button type="submit" >Send</button>
       </div>
    </div>
</form>

<div id="output_message"></div>


<script>
    $(document).ready(function() {
    $('#bicode_form').on('submit',function(e){

        ev.preventDefault();

        // Add text 'loading...' right after clicking on the submit button.
        $('#output_message').text('Loading...');

        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(result){
                console.log(result)
                if (result == 'success'){
                    $('.output_message').text('Message Sent!');
                } else {
                    $('.output_message').text('Error Sending email!');
                }
            }
        });

        // Prevents default submission of the form after clicking on the submit button.
        return false;
    });
});
</script>
