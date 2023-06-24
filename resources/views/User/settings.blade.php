<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold mb-6">Account Settings</h2>

        <!-- Profile Picture -->
        <div class="flex flex-col sm:flex-row items-center mb-8">
            <div class="sm:mr-8">
                <h3 class="text-lg font-semibold mb-2">Profile Picture</h3>
                <img src="" class="rounded-full h-32 w-32 object-cover mb-2" alt="Profile Picture">
            </div>
            <div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="profile_picture" id="profile_picture" class="mb-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        Upload
                    </button>
                </form>
            </div>
        </div>

        <!-- Password Reset -->
        <div class="flex flex-col sm:flex-row items-center mb-8">
            <div class="sm:mr-8">
                <h3 class="text-lg font-semibold mb-2">Password Reset</h3>
            </div>
            <div>
                <form action="" method="POST">
                    @csrf
                    <label for="current_password" class="block mb-2">Current Password:</label>
                    <input type="password" name="current_password" id="current_password" class="border rounded-md px-3 py-2 mb-4 w-full sm:w-auto">

                    <label for="new_password" class="block mb-2">New Password:</label>
                    <input type="password" name="new_password" id="new_password" class="border rounded-md px-3 py-2 mb-4 w-full sm:w-auto">

                    <label for="confirm_password" class="block mb-2">Confirm New Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="border rounded-md px-3 py-2 mb-4 w-full sm:w-auto">

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Account Details -->
        <div class="flex flex-col sm:flex-row items-center">
            <div class="sm:mr-8">
                <h3 class="text-lg font-semibold mb-2">Account Details</h3>
            </div>
            <div>
                <p>Name: {{ $user->name }}</p>
                <p>Email: {{ $user->email }}</p>
            </div>
        </div>
    </div>
</x-layout>