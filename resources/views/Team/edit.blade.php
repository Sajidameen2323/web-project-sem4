<x-layout>



    <div class="mx-auto">
        <a href="{{ route('members.list',$proj_id) }}" class="inline-block mb-4">
            <button class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                MEMBERS
            </button>
        </a>

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('members.update',['id' => $proj_id, 'm_id' => $curr_member->member_id ]) }}">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Project name</label>
                    <input disabled class="disabled shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="{{$proj_name}}" value="{{$proj_name}}">

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="m_name">Member Name</label>
                    <input disabled class="disabled shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="m_name" name="m_name" type="text" placeholder="{{$curr_member->member_name}}" value="{{$curr_member->member_name}}">

                </div>

            </div>

            <div class="grid md:grid-cols-2 gap-x-6 md:mt-4">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" name="role">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role }}" {{ $role == $curr_member->role ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('role'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('role') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status">
                        <option value="">Select Status</option>

                        <option value="1" {{ $curr_member->is_active == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $curr_member->is_active != 1 ? 'selected' : '' }}>Not Active</option>

                    </select>

                    @if($errors->has('status'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('status') }}</p>
                    @endif

                </div>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-x-2 mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update Member
                </button>

                <div class="col-span-3 hidden md:block"></div>

                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset">
                    Clear Fields
                </button>
            </div>
        </form>

    </div>



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

</x-layout>