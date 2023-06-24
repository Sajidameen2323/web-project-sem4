<x-layout>

    <div class="mx-auto">
        <a href="{{ route('tasks.list',$project_id) }}" class="inline-block mb-4">
            <button class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                TASKS
            </button>
        </a>


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

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('tasks.add', $project_id) }}">
            @csrf
            <div class="grid grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Enter Title" value="{{ old('title') }}">

                    @if($errors->has('title'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('title') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="state">State</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="state" name="state" value="{{ old('state') }}">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                        <option value="{{ $state }}" {{ $state ==  old('state') ? 'selected' : '' }}>{{ $state }}</option>
                        @endforeach


                    </select>

                    @if($errors->has('state'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('state') }}</p>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Enter Description">
                {{ old('description') }}
                </textarea>

                @if($errors->has('description'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="assigned_to">Assigned To</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="assigned_to" name="assigned_to">
                        <option value="">Select Assigned To</option>
                        @foreach($proj_members as $member)
                        <option value="{{ $member->employee_id }}" {{ $member->employee_id ==  old('assigned_to') ? 'selected' : '' }}>{{ $member->name }} | {{ $member->role }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('assigned_to'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('assigned_to') }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">Priority</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="priority" name="priority">
                        <option value="">Select Priority</option>
                        @foreach($priorities as $prio)
                        <option value="{{ $prio}}" {{ $prio ==  old('priority') ? 'selected' : '' }}>{{ $prio }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('priority'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('priority') }}</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="effort">Effort</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="effort" name="effort" type="number" placeholder="Enter Effort (Hours)" value="{{ old('effort') }}">

                    @if($errors->has('effort'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('effort') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="target_date">Target Date</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="target_date" name="target_date" type="date" placeholder="Enter Target Date" min="{{ date('Y-m-d') }}" value="{{ old('target_date') }}">

                    @if($errors->has('target_date'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('target_date') }}</p>
                    @endif

                </div>
            </div>
            <div class="grid grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="risk">Risk</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="risk" name="risk">
                        <option value="">Select Risk</option>
                        @foreach($priorities as $prio)
                        <option value="{{ $prio}}" {{ $prio ==  old('risk') ? 'selected' : '' }}>{{ $prio }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('risk'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('risk') }}</p>
                    @endif

                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="type">Type</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type" name="type">
                        <option value="">Select Type</option>
                        @foreach($types as $type)
                        <option value="{{ $type }}" {{ $type ==  old('type') ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('type') }}</p>
                    @endif

                </div>
            </div>


            <div class="grid grid-cols-2 md:grid-cols-5 gap-x-2 mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Add Task
                </button>

                <div class="col-span-3 hidden md:block"></div>

                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset">
                    Clear Fields
                </button>
            </div>
        </form>

    </div>


</x-layout>