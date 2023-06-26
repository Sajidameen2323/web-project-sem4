<x-layout>
    <x-project_layout :title="$title" :project_id="$project_id">

        <div class="grid md:grid-cols-8">

            <form class="md:col-span-7 mb-2" method="get" action="{{ route('tasks.list',$project_id) }}">
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

            @if($write_permission)
            <a href="{{ route('tasks.form', $project_id) }}">
                <button class=" bg-green-500 text-sm hover:bg-green-700 text-white px-4 py-2 rounded mt-4 mx-6 md:mx-0">
                    ADD TASK
                </button>
            </a>
            @endif
        </div>

        <div class="container grid px-6 mx-auto mt-2">


            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Assigned To</th>
                                <th class="px-4 py-3">Title</th>

                                <th class="px-4 py-3">State</th>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Created Date</th>
                                @if($write_permission)
                                <th class="px-4 py-3">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            @foreach($tasks as $task)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar with inset shadow -->
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            <img class="object-cover w-full h-full rounded-full" src="{{ $task->pro_pic }}" alt="" loading="lazy" />
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $task->employee_name }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $task->employee_role }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('tasks.view',['id'=>$project_id, 't_id' => $task->id]) }}" class="hover:underline hover:text-green-500">
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
                                @if($write_permission)
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">

                                        <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" href="{{ route('tasks.edit',['id'=> $project_id ,'t_id'=>$task->id]) }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <a class="cursor-pointer flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" onclick="event.preventDefault();
                                            if (confirm('Are you sure you want to delete this item?')) {
                                                document.getElementById('delete-form-{{ $task->id }}').submit();
                                            }">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>

                                        <form id="delete-form-{{$task->id}}" action="{{ route('tasks.delete',$task->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>


                                    </div>
                                </td>
                                @endif
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
    </x-project_layout>
</x-layout>