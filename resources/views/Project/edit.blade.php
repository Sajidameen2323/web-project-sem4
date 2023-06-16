<x-layout>

    <div class="mx-auto">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('projects.update', $project->project_id) }}">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-2 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="project_name">Project Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $project->project_name }}" id="project_name" name="project_name" type="text" placeholder="Enter project name">

                    @if($errors->has('project_name'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('project_name') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="subtitle">Subtitle</label>
                    <input value="{{ $project->subtitle }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="subtitle" name="subtitle" type="text" placeholder="Enter subtitle">

                    @if($errors->has('subtitle'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('subtitle') }}</p>
                    @endif

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">Start Date</label>
                    <input value="{{ $project->start_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_date" name="start_date" type="date">

                    @if($errors->has('start_date'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('start_date') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="end_date">End Date</label>
                    <input value="{{ $project->end_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_date" name="end_date" type="date">

                    @if($errors->has('end_date'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('end_date') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">Priority</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="priority" name="priority">
                        <option value="">Select Priority</option>
                        <option value="High" {{ $project->priority == "High" ? 'selected' : '' }}>High</option>
                        <option value="Medium" {{ $project->priority == "Medium" ? 'selected' : '' }}>Medium</option>
                        <option value="Low" {{ $project->priority == "Low" ? 'selected' : '' }}>Low</option>
                    </select>

                    @if($errors->has('priority'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('priority') }}</p>
                    @endif

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="project_manager">Project Manager</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="project_manager" name="project_manager">
                        <option value="">Select Project Manager</option>
                        @foreach($managers as $manager)

                        <option value="{{ $manager->id }}" {{ $project->project_manager == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>

                        @endforeach
                        <!-- Add options for project managers here -->
                    </select>

                    @if($errors->has('project_manager'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('project_manager') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="team_lead">Team Lead</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="team_lead" name="team_lead">
                        <option value="">Select Team Lead</option>
                        <!-- Add options for team leads here -->

                        @foreach($seniors as $senior)

                        <option value="{{ $senior->id }}" {{ $project->team_lead == $senior->id ? 'selected' : '' }}>{{ $senior->name }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('team_lead'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('team_lead') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="Active" {{ $project->status == "Active" ? 'selected' : '' }}>Active</option>
                        <option value="Scheduled" {{ $project->status == "Scheduled" ? 'selected' : '' }}>Scheduled</option>

                    </select>

                    @if($errors->has('status'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('status') }}</p>
                    @endif

                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-x-6 md:mt-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="frontend">Frontend</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="frontend" name="frontend">
                        <option value="">Select Frontend</option>
                        <!-- Add options for frontend here -->

                        @foreach($frontend_arr as $el)

                        <option value="{{ $el }}" {{ $project->frontend == $el ? 'selected' : '' }}>{{ $el }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('frontend'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('frontend') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="backend">Backend</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="backend" name="backend">
                        <option value="">Select Backend</option>
                        <!-- Add options for backend here -->

                        @foreach($backend_arr as $el)

                        <option value="{{ $el }}" {{ $project->backend == $el ? 'selected' : '' }}>{{ $el }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('backend'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('backend') }}</p>
                    @endif

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="database">Database</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="database" name="database">
                        <option value="">Select Database</option>
                        <!-- Add options for database here -->

                        @foreach($db_arr as $el)

                        <option value="{{ $el }}" {{ $project->database == $el ? 'selected' : '' }}>{{ $el }}</option>

                        @endforeach

                    </select>

                    @if($errors->has('database'))
                    <p class="text-red-500 text-xs italic">{{ $errors->first('database') }}</p>
                    @endif

                </div>
            </div>

            <div class="my-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Enter description">
                {{ $project->description }}
                </textarea>

                @if($errors->has('description'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
                @endif

            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-x-2 mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update Project
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