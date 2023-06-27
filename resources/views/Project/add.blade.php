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
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('projects.add') }}">
            @csrf
            <div class="grid md:grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="project_name">Project Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="project_name" name="project_name" type="text" value="{{old('project_name')}}" placeholder="Enter project name">

                    @if($errors->has('project_name'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('project_name') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="subtitle">Subtitle</label>
                    <input value="{{old('subtitle')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subtitle" name="subtitle" type="text" placeholder="Enter subtitle">

                    @if($errors->has('subtitle'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('subtitle') }}</p>
                    @endif

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">Start Date</label>
                    <input value="{{old('start_date')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_date" name="start_date" type="date">

                    @if($errors->has('start_date'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('start_date') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="end_date">End Date</label>
                    <input value="{{old('end_date')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_date" name="end_date" type="date">

                    @if($errors->has('end_date'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('end_date') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">Priority</label>
                    <select value="{{old('priority')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="priority" name="priority">
                        <option value="">Select Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>

                    @if($errors->has('priority'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('priority') }}</p>
                    @endif

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="project_manager">Project Manager</label>
                    <select value="{{old('project_manager')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="project_manager" name="project_manager">
                        <option value="">Select Project Manager</option>
                        @foreach($managers as $manager)

                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>

                        @endforeach
                        <!-- Add options for project managers here -->
                    </select>

                    @if($errors->has('project_manager'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('project_manager') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="team_lead">Team Lead</label>
                    <select value="{{old('team_lead')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="team_lead" name="team_lead">
                        <option value="">Select Team Lead</option>
                        <!-- Add options for team leads here -->

                        @foreach($seniors as $senior)

                        <option value="{{ $senior->id }}">{{ $senior->name }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('team_lead'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('team_lead') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
                    <select value="{{old('status')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status">
                        <option value="">Select Status</option>
                        @foreach($status_arr as $el)

                        <option value="{{ $el }}">{{ $el }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('status'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('status') }}</p>
                    @endif

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="frontend">Frontend</label>
                    <select value="{{old('frontend')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="frontend" name="frontend">
                        <option value="">Select Frontend</option>
                        <!-- Add options for frontend here -->

                        @foreach($frontend_arr as $el)

                        <option value="{{ $el }}">{{ $el }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('frontend'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('frontend') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="backend">Backend</label>
                    <select value="{{old('backend')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="backend" name="backend">
                        <option value="">Select Backend</option>
                        <!-- Add options for backend here -->

                        @foreach($backend_arr as $el)

                        <option value="{{ $el }}">{{ $el }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('backend'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('backend') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="database">Database</label>
                    <select value="{{old('database')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="database" name="database">
                        <option value="">Select Database</option>
                        <!-- Add options for database here -->

                        @foreach($db_arr as $el)

                        <option value="{{ $el }}">{{ $el }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('database'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('database') }}</p>
                    @endif

                </div>
            </div>

            <div class="my-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                <textarea value="{{old('description')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Enter description">{{old('description')}}</textarea>

                @if($errors->has('description'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
                @endif

            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-x-2 mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Project
                </button>

                <div class="col-span-3 hidden md:block"></div>

                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset">
                    Clear Fields
                </button>
            </div>
        </form>

    </div>




</x-layout>