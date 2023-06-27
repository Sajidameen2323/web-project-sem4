<x-layout>

    <div class="container mx-auto px-4 py-10">

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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-10">
            <div class="md:col-span-1 px-4 mb-8 md:mb-0 ">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden ">
                    <div class="relative pb-48 overflow-hidden bg-gray-700">
                        <img class="absolute inset-0 h-full w-full object-cover" id="previewImage" src="{{ $pro_pic }}" alt="">
                    </div>
                    <form class="p-4 bg-gray-700" action="{{ route('update.profile_pic') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-xl font-semibold text-gray-200">Profile Picture</h2>
                        <p class="text-gray-300 my-2">Update your profile picture here.</p>
                        <input name="pic" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none " aria-describedby="user_avatar_help" accept="image/*" id="imageInput" type="file">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">A profile picture is useful to confirm your are logged into your account</div>
                        @if($errors->has('pic'))
                        <p class="text-red-500 text-xs italic">{{ $errors->first('pic') }}</p>
                        @endif
                        <button type="submit" class="mt-2 text-white bg-green-600 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Update</button>
                    
                        <button type="reset" id="restore_pic" class="mt-2 text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Reset</button>

                    </form>
                </div>
            </div>
            <div class="md:col-span-2 px-4">
                <div class="bg-gray-700 rounded-lg shadow-lg overflow-hidden">

                    <form action="{{ route('update.name') }}" method="post" class="p-4 border-b">
                        @csrf
                        <h2 class="text-xl font-semibold text-gray-200 mb-4">Account Details </h2>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="text" name="name" value="{{ auth()->user()->name }}" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full Name</label>
                            @if($errors->has('name'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="email" disabled value="{{auth()->user()->email}}" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <input disabled value="{{$role->role}}" type="text" name="role" id="role" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="role" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Role</label>
                        </div>

                        <button class="mt-2 text-white bg-green-600 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Update</button>
                        <button type="reset"  class="mt-2 text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Reset</button>

                   
                    </form>
                </div>
            </div>
            <div class="md:col-span-3 px-4">
                <div class="bg-gray-700 rounded-lg shadow-lg overflow-hidden">
                    <form action="{{ route('update.password') }}" method='post' class='p-4 border-b'>
                        @csrf
                        <h2 class='text-xl font-semibold text-gray-300'>Password Change</h2>
                        <p class='text-gray-400 mt-2'>Change your password here.</p>

                        <div class="relative z-0 w-full mb-6 group my-2 mt-4">
                            <input value="{{old('current_password')}}" type="password" name="current_password" id="current_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="current_password" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Current password</label>

                            @if($errors->has('current_password'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('current_password') }}</p>
                            @endif
                        </div>
                        <div class="relative z-0 w-full mb-6 group my-2">
                            <input value="{{old('new_password')}}" type="password" name="new_password" id="new_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="new_password" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">New password</label>

                            @if($errors->has('new_password'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('new_password') }}</p>
                            @endif
                        </div>
                        <div class="relative z-0 w-full mb-6 group my-2">
                            <input value="{{old('confirm_password')}}" type="password" name="confirm_password" id="confirm_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="confirm_password" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>

                            @if($errors->has('confirm_password'))
                            <p class="text-red-500 text-xs italic">{{ $errors->first('confirm_password') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="mt-2 text-white bg-green-600 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get references to the input and image elements
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');

        const restorePicBtn = document.getElementById('restore_pic');
        
        // Add an event listener to the input element
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            // Check if a file was selected
            if (file) {
                // Create a FileReader object
                const reader = new FileReader();

                // Set the onload event handler
                reader.onload = function() {
                    // Update the src attribute of the image element
                    previewImage.src = reader.result;
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            }
        });

        restorePicBtn.addEventListener('click',function(event){

            
            previewImage.src = "{{ asset('storage/'.$pro_pic) }}";
        });
    </script>
</x-layout>