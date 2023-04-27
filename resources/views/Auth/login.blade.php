<x-guestlayout>



    <div class="h-screen flex items-center justify-center">
        <div class="w-full md:w-2/5">

            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('authenticate') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="email">
                        Email
                    </label>
                    <input name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email">

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
                    <input name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">

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
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Sign In
                    </button>
                </div>
            </form>

        </div>
    </div>


    </x-guestlayou>