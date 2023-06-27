<x-layout>

    <div class="mx-auto">
        @if (session()->has('success'))

        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 " role="alert">
            <span class="font-medium">{{ session()->get('success') }}</span>
        </div>

        @endif
        @if (session()->has('failed'))

        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 " role="alert">
            <span class="font-medium">{{ session()->get('failed') }}</span>
        </div>

        @endif
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('employees.add') }}">
            @csrf
            <div class="grid md:grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Employee name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Enter Full Name">

                    @if($errors->has('name'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Enter Email">

                    @if($errors->has('email'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
                    @endif

                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-x-6 md:mt-4">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" name="role">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('role'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('role') }}</p>
                    @endif

                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Create a password</label>
                    <div class="relative">
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="Enter password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor" onclick="togglePasswordVisibility()">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M10 4a6 6 0 00-6 6c0 2.519 1.567 4.67 3.78 5.561a.5.5 0 00.44 0C14.433 14.67 16 12.519 16 10a6 6 0 00-6-6zm0 10a4 4 0 100-8 4 4 0 000 8zm-7.286-4a8.001 8.001 0 0114.572 0A7.97 7.97 0 0116 10c0 2.18-.88 4.145-2.286 5.571A8.001 8.001 0 013.714 10z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    @if($errors->has('password'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <script>
                    function togglePasswordVisibility() {
                        var passwordInput = document.getElementById("password");
                        var eyeIcon = document.querySelector("svg");
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            eyeIcon.innerHTML = '<path fill-rule="evenodd" d="M10 4a6 6 0 00-6 6c0 2.519 1.567 4.67 3.78 5.561a.5.5 0 00.44 0C14.433 14.67 16 12.519 16 10a6 6 0 00-6-6zm0 10a4 4 0 100-8 4 4 0 000 8zm-7.286-4a8.001 8.001 0 0114.572 0A7.97 7.97 0 0116 10c0 2.18-.88 4.145-2.286 5.571A8.001 8.001 0 013.714 10z" clip-rule="evenodd"/>';
                        } else {
                            passwordInput.type = "password";
                            eyeIcon.innerHTML = '<path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>' +
                                '<path fill-rule="evenodd" d="M10 4a6 6 0 00-6 6c0 2.519 1.567 4.67 3.78 5.561a.5.5 0 00.44 0C14.433 14.67 16 12.519 16 10a6 6 0 00-6-6zm0 10a4 4 0 100-8 4 4 0 000 8zm-7.286-4a8.001 8.001 0 0114.572 0A7.97 7.97 0 0116 10c0 2.18-.88 4.145-2.286 5.571A8.001 8.001 0 013.714 10z" clip-rule="evenodd"/>';
                        }
                    }
                </script>



            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-x-2 mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Employee
                </button>

                <div class="col-span-3 hidden md:block"></div>

                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset">
                    Clear Fields
                </button>
            </div>
        </form>

    </div>





</x-layout>