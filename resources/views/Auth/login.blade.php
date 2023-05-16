<x-guestlayout>

    <!DOCTYPE html>

    <head>
        <title>Login Form</title>
        <style>
            body {
                background-color: #f1f1f1;
            }

            .container {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                height: 100vh;
                width: 100%;
            }

            .login-form {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0px 0px 5px 0px rgba(187, 161, 161, 0.75);
                margin-right: 0px;
                width: 400px;
                background: transparent;
                font-family: 'Red Rose', cursive;
            }

            .login-form h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            .login-form input[type=text],
            .login-form input[type=password] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;

            }

            .login-form button[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
                justify-content: center;
                align-items: center;


            }

            .login-form button[type=submit]:hover {
                background-color: #45a049;

            }

            .picture {
                margin-left: 01px;
                max-width: 400px;
                max-height: 400px;

            }

            .bd {
                background-image: URL('images/BG1edit.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;

            }

            .headLog {
                color: #ffffff;
                text-align: center;
                font-size: 25px;
            }

            .logEp {
                color: #ffffff;
                font-size: 15px;
            }

            /* #submit {
                justify-content: center;
                align-items: center;
            } */
        </style>
    </head>

    <body>
        <div class="bd" id="bd1">
            <div class="container">
                <form class="login-form" method="POST" action="{{ route('authenticate') }}">
                    @csrf
                    <h1 class="headLog">Login</h2>
                        <label for="email" class="logEp">Email Address</label>
                        @if ($errors->has('email'))
                            <p class="text-red-500 text-xs italic mt-1">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                        <input id="email" type="text" name="email" required autofocus>
                        <label for="password" class="logEp">Password</label>
                        <input id="password" type="password" name="password" required>
                        <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input class="mr-2 leading-tight" type="checkbox" name="remember">
                                            <label class="text-gray-700 font-bold">
                                                Remember me
                                            </label>
                                        </div>
                                        <div class="text-sm">
                                            <a class="text-blue-500 hover:text-blue-700" href="/password/reset">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                        <button type="submit" id="submit">Login</button>
                </form>
                {{-- <img class="picture" src="{{ url('images/Test1.jpg') }}" alt="Your Image"> --}}
            </div>
        </div>
    </body>

    </html>


    </x-guestlayout>
