<x-guestlayout>

    <!DOCTYPE html>
    <html lang="en">

    {{-- <head>
        <title>Center Table in Middle</title>
        <style>
            .container {
                position: relative;
                height: 400px;
                width: 100%;
                border: 1px;


            }

            table {
                position: absolute;
                bottom: 0;
                margin: 0 auto;
                right: 50%;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <table>
                <tr>
                    <th>
                        <div class="h-screen flex items-center justify-center">
                            <div class="w-full md:w-2/5">

                                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                                    action="{{ route('authenticate') }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2" for="email">
                                            Email
                                        </label>
                                        <input name="email"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="email" type="email" placeholder="Email">

                                        @if ($errors->has('email'))
                                            <p class="text-red-500 text-xs italic mt-1">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="mb-6">
                                        <label class="block text-gray-700 font-bold mb-2" for="password">
                                            Password
                                        </label>
                                        <input name="password"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="password" type="password" placeholder="******************">

                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input class="mr-2 leading-tight" type="checkbox" name="remember">
                                            <label class="text-gray-700 font-bold">
                                                Remember me
                                            </label>
                                        </div>
                                        <div class="text-sm">
                                            <a class="text-blue-500 hover:text-blue-700" href="#">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            type="submit">
                                            Sign In
                                        </button>
                                    </div>
                                </form>

                            </div>
                    </th>
                    <th>Header 2</th>
                    <th></th>
                </tr>


            </table>
        </div>
    </body> --}}

    <!DOCTYPE html>
    <html>

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
                        <button type="submit" id="submit">Login</button>
                </form>
                {{-- <img class="picture" src="{{ url('images/Test1.jpg') }}" alt="Your Image"> --}}
            </div>
        </div>
    </body>

    </html>


    </html>

    </x-guestlayou>
