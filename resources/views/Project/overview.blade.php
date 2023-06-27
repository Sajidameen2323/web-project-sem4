<x-layout>
    <!-- <h5>Hajhahaha</h5>
    @if(isset($data))

    <p> <?php print_r($data->project_name) ?> </p>
    <p> <?php print_r($data->start_date) ?> </p>
    <p> <?php print_r($data->project_manager) ?> </p>
    @endif -->

    <x-project_layout :title="$title" :project_id="$project_id">

        <div class="grid lg:grid-cols-5 grid-cols-1 gap-4">
            <!-- CTA -->
            <div class="col md:col-span-3 p-4 mb-8 text-sm font-semibold text-purple-100 bg-gray-700 shadow-lg rounded-lg focus:outline-none focus:shadow-outline-purple" href="#">

                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-200 mb-4">{{$data->project_name}}</h2>
                    <p class="text-gray-400">{{$data->description}}</p>
                    <h3 class="text-lg font-semibold text-gray-200 mt-4">Technology used:</h3>

                    <div class="mt-4">
                        <button class="bg-green-500 rounded-full py-1 px-3 text-xs font-semibold text-white cursor-not-allowed">
                            {{$data->frontend}}
                        </button>
                        <button class="bg-yellow-400 rounded-full py-1 px-3 text-xs font-semibold text-white cursor-not-allowed">
                            {{$data->backend}}
                        </button>
                        <button class="bg-blue-500 rounded-full py-1 px-3 text-xs font-semibold text-white cursor-not-allowed">
                            {{$data->database}}
                        </button>

                    </div>

                    <h3 class="text-lg font-semibold text-gray-200 mt-4">Languages:</h3>
                    <p class="text-gray-400">PHP, JSX, SQL.</p>
                </div>


            </div>
            <div class="col md:col-span-2 p-4 mb-8 text-sm font-semibold bg-gray-700 shadow-lg rounded-lg focus:outline-none focus:shadow-outline-purple">
                <div class="bg-gray-500 shadow-md rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-200">Project Stats</h2>
                        <svg class="w-6 h-6 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-gray-200">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold" id="number" data-val="{{ $tot_tasks }}">{{ $tot_tasks}}</h3>
                            <p class="text-sm">Tasks</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-2xl font-bold">{{ $tot_members}}</h3>
                            <p class="text-sm">Members</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-2xl font-bold">{{ $tot_commits}}</h3>
                            <p class="text-sm">Commits</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 p-6 gap-y-4 gap-x-10">
                    <!-- ... -->
                    <div class="flex flex-col">
                        <h5 class="font-medium text-lg text-gray-200">
                            <svg class="w-4 h-4 inline-block mr-1 text-gray-200" height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 502.686 502.686" xml:space="preserve">
                                <g>
                                    <g>
                                        <polygon style="fill:#ffffff;" points="183.19,327.854 75.962,351.625 33.834,502.664 218.415,502.664 237.742,341.034 205.171,305.787 		" />
                                        <polygon style="fill:#ffffff;" points="426.681,351.625 319.366,327.854 297.342,305.809 264.878,341.056 284.184,502.686 468.852,502.686 		" />
                                        <path style="fill:#ffffff;" d="M251.332,170.064c72.586,0,131.409-7.291,131.409-16.308c0-1.941-3.236-3.84-8.499-5.565 C370.273,81.645,370.683,0,251.375,0S132.434,81.645,128.508,148.17c-5.285,1.747-8.564,3.645-8.564,5.587 C119.944,162.773,178.811,170.064,251.332,170.064z" />
                                        <path style="fill:#ffffff;" d="M360.955,179.943c-23.965,3.904-61.39,6.428-103.928,6.428c-50.109,0-93.229-3.494-115.296-8.607 c7.787,69.156,53.668,122.544,109.795,122.544C306.985,300.265,352.305,248.021,360.955,179.943z" />
                                    </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                    <g> </g>
                                </g>
                            </svg>
                            Project Manager
                        </h5>
                        <span class="font-medium text-sm text-gray-400 ml-8">{{$project_manager}}</span>
                    </div>
                    <div class="flex flex-col">
                        <h5 class="font-medium text-lg text-gray-200">
                            <svg class="w-4 h-4 inline-block mr-1 text-gray-200" height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 502.686 502.686" xml:space="preserve"> <g> <g> <polygon style="fill:#ffffff;" points="183.19,327.854 75.962,351.625 33.834,502.664 218.415,502.664 237.742,341.034 205.171,305.787 		" /> <polygon style="fill:#ffffff;" points="426.681,351.625 319.366,327.854 297.342,305.809 264.878,341.056 284.184,502.686 468.852,502.686 		" /> <path style="fill:#ffffff;" d="M251.332,170.064c72.586,0,131.409-7.291,131.409-16.308c0-1.941-3.236-3.84-8.499-5.565 C370.273,81.645,370.683,0,251.375,0S132.434,81.645,128.508,148.17c-5.285,1.747-8.564,3.645-8.564,5.587 C119.944,162.773,178.811,170.064,251.332,170.064z" /> <path style="fill:#ffffff;" d="M360.955,179.943c-23.965,3.904-61.39,6.428-103.928,6.428c-50.109,0-93.229-3.494-115.296-8.607 c7.787,69.156,53.668,122.544,109.795,122.544C306.985,300.265,352.305,248.021,360.955,179.943z" /> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </g> </svg>

                            Team Lead
                        </h5>
                        <span class="font-medium text-sm text-gray-400 ml-8">{{$team_lead}}</span>
                    </div>
                    <div class="flex flex-col">
                        <h5 class="font-medium text-lg text-gray-200">
                            <svg class="w-4 h-4 inline-block mr-1 text-gray-200 text-gray-200" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="Calendar / Timer">
                                    <path id="Vector" d="M12 13V9M21 6L19 4M10 2H14M12 21C7.58172 21 4 17.4183 4 13C4 8.58172 7.58172 5 12 5C16.4183 5 20 8.58172 20 13C20 17.4183 16.4183 21 12 21Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                            Delivery Date
                        </h5>
                        <span class="font-medium text-sm text-gray-400 ml-8">{{$data->end_date}}</span>
                    </div>
                    <div class="flex flex-col">
                        <h5 class="font-medium text-lg text-gray-200">
                        <svg class="w-4 h-4 inline-block mr-1 text-gray-200 text-gray-200" fill="#ffffff" width="800px" height="800px" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M500 70q-117 0-217 59-97 57-154 154-59 100-59 217t59 217q57 97 154 154 100 59 217 59t217-59q97-57 154-154 59-100 59-217t-59-217q-57-97-154-154-100-59-217-59zm0 108q79 0 148 36t114.5 99.5T819 455h-69q-12 0-25.5-6.5T704 432l-86-114q-7-10-17.5-10T583 318L417 540q-7 9-17.5 9t-17.5-9l-46-61q-7-10-20.5-17t-24.5-7H181q11-78 56.5-141.5T352 214t148-36zm0 644q-79 0-148-36t-114.5-99.5T181 545h69q12 0 25.5 7t20.5 16l86 115q7 9 17.5 9t17.5-9l166-222q7-10 17.5-10t17.5 10l46 61q7 9 20.5 16t24.5 7h110q-11 78-56.5 141.5T648 786t-148 36z"/></svg>
                            Status
                        </h5>
                        <span class="font-medium text-sm text-gray-400 ml-8">{{$data->status}}</span>
                    </div>
                </div>

            </div>


        </div>

        </div>

        <script defer>
            const targetNumber = document.getElementById("number").dataset.val || 0; // The target number to animate to
            const duration = 2000; // Animation duration in milliseconds

            let currentNumber = 0;
            const increment = Math.ceil(targetNumber / (duration / 16)); // Increment amount per frame (assumes 60fps)

            function animateNumbers() {
                if (currentNumber < targetNumber) {
                    currentNumber += increment;
                    if (currentNumber > targetNumber) {
                        currentNumber = targetNumber;
                    }
                    document.getElementById("number").textContent = currentNumber;
                    requestAnimationFrame(animateNumbers);
                }
            }

            setTimeout(animateNumbers, 1000); // Start the animation after 1 second
        </script>

    </x-project_layout>
</x-layout>