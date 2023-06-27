<x-layout>
    <div class="mx-6 my-4">
        <h3 class="font-semibold text-lg uppercase">Tasks Assigned To You</h3>
    </div>

    <div class="grid md:grid-cols-8">

        <form class="md:col-span-7 mb-2" method="get" action="{{ route('tasks.my') }}">
            @csrf
            @method('GET')
            <span class="mx-6 text-xs text-gray-800 ">Filter tasks by state</span>
            <div class="flex justify-start items-center mx-6">
                <div class="relative">
                    <select class="block appearance-none bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="filter">
                        <option value="">Select Status</option>
                        <option value="Pending" {{ $filterValue == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ $filterValue == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $filterValue == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Removed" {{ $filterValue == 'Removed' ? 'selected' : '' }}>Removed</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>
                    </div>
                </div>
                <button class="mx-2 bg-green-500 text-sm hover:bg-green-700 text-white px-4 py-2 rounded">FILTER</button>
            </div>

        </form>

    </div>

    <div class="container grid px-6 mx-auto mt-2">

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Project</th>
                            <th class="px-4 py-3">Title</th>

                            <th class="px-4 py-3">State</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Created Date</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @foreach($tasks as $task)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                          
                                    <div>
                                        <p class="font-semibold">{{ $task->proj_name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $task->proj_subtitle }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('tasks.view',['id'=>$task->project_id, 't_id' => $task->id]) }}" class="hover:underline hover:text-green-500">
                                    {{ $task->title }}
                                </a>

                            </td>
                            <td class="px-4 py-3 text-xs">
                                <span @class([ "px-2 py-1 font-semibold leading-tight rounded-full text-gray-200" , 'bg-red-700'=> $task->state === 'Removed',
                                    'bg-yellow-500' => $task->state === 'In Progress',
                                    'bg-orange-500' => $task->state === 'Pending',
                                    'bg-green-700' => $task->state === 'Completed',

                                    ])>
                                    {{ $task->state }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs">

                                <span @class([ "px-2 py-1 font-semibold leading-tight rounded-full text-gray-200" , 'text-red-600 border-2 border-red-600'=> $task->type === 'Bug',
                                    'text-purple-600 border-2 border-purple-600' => $task->type === 'Test Case',
                                    'text-orange-500 border-2 border-orange-500' => $task->type === 'Issue',
                                    'text-green-500 border-2 border-green-500' => $task->type === 'Feature',

                                    ])>
                                    {{ $task->type }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">

                                <?php
                                $date = new DateTime($task->created_at);
                                $formattedDate = $date->format("Y-m-d");
                                echo $formattedDate;
                                ?>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="flex justify-center my-4">
        {!! $tasks->links() !!}
    </div>

</x-layout>