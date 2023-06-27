<div class="container grid px-6 mx-auto">
    <div>
        <!-- Component content -->

    </div>
    <div @class([ "grid grid-cols-1 md:grid-cols-2  gap-4 my-10" , 'lg:grid-cols-3'=> !$write_permission,
        'lg:grid-cols-5'=> $write_permission,
        ])
        >

        <a href="{{route('project.view', $attributes->filter(fn (string $value, string $key) => $key == 'project_id')->get('project_id') )}}" class="bg-gray-700 border border-gray-800 text-gray-200 shadow-md rounded-lg p-4 flex flex-col items-center justify-center hover:bg-gray-600 transition duration-300 ease-in-out transform hover:scale-105">
            <svg class="w-10 h-10 text-gray-200 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-200">Overview</h2>
        </a>

        <a href="{{route('members.list', $attributes->filter(fn (string $value, string $key) => $key == 'project_id')->get('project_id') )}}" class="bg-gray-700 border border-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center justify-center hover:bg-gray-600 transition duration-300 ease-in-out transform hover:scale-105">
            <svg class="w-10 h-10 text-gray-200 mb-2" height="800px" width="800px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                <style type="text/css">
                    .st0 {
                        fill: #ffffff;
                    }
                </style>
                <g>
                    <path class="st0" d="M435.95,287.525c32.51,0,58.87-26.343,58.87-58.853c0-32.51-26.361-58.871-58.87-58.871 c-32.502,0-58.863,26.361-58.863,58.871C377.088,261.182,403.448,287.525,435.95,287.525z" />
                    <path class="st0" d="M511.327,344.251c-2.623-15.762-15.652-37.822-25.514-47.677c-1.299-1.306-7.105-1.608-8.673-0.636 c-11.99,7.374-26.074,11.714-41.19,11.714c-15.099,0-29.184-4.34-41.175-11.714c-1.575-0.972-7.373-0.67-8.672,0.636 c-2.757,2.757-5.765,6.427-8.698,10.683c7.935,14.94,14.228,30.81,16.499,44.476c2.27,13.7,1.533,26.67-2.138,38.494 c13.038,4.717,28.673,6.787,44.183,6.787C476.404,397.014,517.804,382.987,511.327,344.251z" />
                    <path class="st0" d="M254.487,262.691c52.687,0,95.403-42.716,95.403-95.402c0-52.67-42.716-95.386-95.403-95.386 c-52.678,0-95.378,42.716-95.378,95.386C159.109,219.975,201.808,262.691,254.487,262.691z" />
                    <path class="st0" d="M335.269,277.303c-2.07-2.061-11.471-2.588-14.027-1.006c-19.448,11.966-42.271,18.971-66.755,18.971 c-24.466,0-47.3-7.005-66.738-18.971c-2.555-1.583-11.956-1.055-14.026,1.006c-16.021,16.004-37.136,51.782-41.384,77.288 c-10.474,62.826,56.634,85.508,122.148,85.508c65.532,0,132.639-22.682,122.165-85.508 C372.404,329.085,351.289,293.307,335.269,277.303z" />
                    <path class="st0" d="M76.049,287.525c32.502,0,58.862-26.343,58.862-58.853c0-32.51-26.36-58.871-58.862-58.871 c-32.511,0-58.871,26.361-58.871,58.871C17.178,261.182,43.538,287.525,76.049,287.525z" />
                    <path class="st0" d="M115.094,351.733c2.414-14.353,9.225-31.253,17.764-46.88c-2.38-3.251-4.759-6.083-6.955-8.279 c-1.299-1.306-7.097-1.608-8.672-0.636c-11.991,7.374-26.076,11.714-41.182,11.714c-15.108,0-29.202-4.34-41.183-11.714 c-1.568-0.972-7.382-0.67-8.681,0.636c-9.887,9.854-22.882,31.915-25.514,47.677c-6.468,38.736,34.924,52.762,75.378,52.762 c14.437,0,29.016-1.777,41.459-5.84C113.587,379.108,112.757,365.835,115.094,351.733z" />
                </g>
            </svg>
            <h2 class="text-lg font-semibold text-gray-200">Team</h2>
        </a>

        <a href="{{route('tasks.list', $attributes->filter(fn (string $value, string $key) => $key == 'project_id')->get('project_id') )}}" class="bg-gray-700 border border-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center justify-center hover:bg-gray-600 transition duration-300 ease-in-out transform hover:scale-105">
            <svg class="w-10 h-10 text-gray-200 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-200">Tasks</h2>
        </a>

        @if($write_permission)
        <a href="{{ route('projects.edit', $attributes->filter(fn (string $value, string $key) => $key == 'project_id')->get('project_id')) }}" class="bg-gray-700 border border-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center justify-center hover:bg-gray-600 transition duration-300 ease-in-out transform hover:scale-105">
            <svg class="w-10 h-10 text-gray-200 mb-2" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title />
                <g id="Complete">
                    <g id="edit">
                        <g>
                            <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </g>
                    </g>
                </g>
            </svg>

            <h2 class="text-lg font-semibold text-gray-200">Edit</h2>
        </a>

        <a href="{{ route('projects.reports', $attributes->filter(fn (string $value, string $key) => $key == 'project_id')->get('project_id')) }}" class="bg-gray-700 border border-gray-800 shadow-md rounded-lg p-4 flex flex-col items-center justify-center hover:bg-gray-600 transition duration-300 ease-in-out transform hover:scale-105">
            <svg class="w-10 h-10 text-gray-200 mb-2" xmlns="http://www.w3.org/2000/svg" fill="#fff" width="800px" height="800px" viewBox="0 0 36 36">
                <rect x="6.48" y="18" width="5.76" height="11.52" rx="1" ry="1" />
                <rect x="15.12" y="6.48" width="5.76" height="23.04" rx="1" ry="1" />
                <rect x="23.76" y="14.16" width="5.76" height="15.36" rx="1" ry="1" />
            </svg>

            <h2 class="text-lg font-semibold text-gray-200">Reports</h2>
        </a>
        @endif
    </div>



    <div class="h-screen">
        {{ $slot }}
    </div>

</div>