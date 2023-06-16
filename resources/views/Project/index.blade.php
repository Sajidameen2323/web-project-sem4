<x-layout>

    <div class="flex flex-col items-stretch">
        <div>
            <div class="grid md:grid-cols-5">
                <div class="md:col-span-4">

                </div>
                <a href="{{ route('projects.addform')}}">
                    <button class="px-6 py-3 text-white transition-colors duration-300 ease-in-out bg-gradient-to-r from-green-400 to-green-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 rounded-lg shadow-lg">
                        CREATE PROJECT

                    </button>
                </a>


            </div>


            <section x-data="xData()" class=" py-10 px-12">
                <!-- Card Grid -->
                <div class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">


                    @foreach ($projects as $project)
                    <!-- Card Item -->
                    <div class="w-full max-w-sm bg-gray-700 border border-gray-800 rounded-lg shadow ">
                        <div class="flex justify-end px-4 pt-4">
                            <button id="dropdownButton" data-dropdown-toggle="dropdown-{{ $project->project_id }}" class="inline-block text-gray-500  hover:bg-gray-600  focus:ring-4 focus:outline-none focus:ring-gray-800  rounded-lg text-sm p-1.5" type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown-{{ $project->project_id }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="dropdownButton">
                                    <li>
                                        <a href="{{ route('projects.edit', $project->project_id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a>
                                    </li>
                                    <li>

                                        <!-- <a href="{{ route('projects.delete', ['id' => $project->project_id]) }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a> -->

                                        <a href="{{ route('projects.delete', $project->project_id) }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" onclick="event.preventDefault();
                                            if (confirm('Are you sure you want to delete this item?')) {
                                                document.getElementById('delete-form-{{ $project->project_id }}').submit();
                                            }">
                                            Delete
                                        </a>

                                        <form id="delete-form-{{$project->project_id}}" action="{{ route('projects.delete', $project->project_id ) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex flex-col items-center pb-10">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="https://automynd.com/assets/automynd.png" alt="Bonnie image" />
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$project->project_name}}</h5>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{$project->subtitle}}</span>
                            <div class="flex mt-4 space-x-3 md:mt-6">
                                <a href="{{ route('project.view',['id'=>$project->project_id]) }}" class="inline-flex w-100 items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-500 dark:hover:bg-green-700 dark:focus:ring-green-800">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="flex justify-center my-4">
                    {!! $projects->links() !!}
                </div>
            </section>

        </div>



    </div>







</x-layout>