<x-layout>

    <div class="mx-auto ">
        <a href="{{ route('tasks.list',$project_id) }}" class="inline-block mb-4 float-left">
            <button class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                TASKS
            </button>
        </a>
        <a href="{{ route('tasks.edit',['id'=> $project_id ,'t_id'=>$task->id]) }}" class="inline-block mb-4 float-right">
            <button class="flex items-center px-4 py-2 bg-purple-500 text-white rounded-md">
                <svg class="h-4 w-4 mx-2 text-gray-200" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>edit [#1479]</title>
                    <desc>Created with Sketch.</desc>
                    <defs> </defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Dribbble-Light-Preview" transform="translate(-99.000000, -400.000000)" fill="#fffabe">
                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                <path d="M61.9,258.010643 L45.1,258.010643 L45.1,242.095788 L53.5,242.095788 L53.5,240.106431 L43,240.106431 L43,260 L64,260 L64,250.053215 L61.9,250.053215 L61.9,258.010643 Z M49.3,249.949769 L59.63095,240 L64,244.114985 L53.3341,254.031929 L49.3,254.031929 L49.3,249.949769 Z" id="edit-[#1479]"> </path>
                            </g>
                        </g>
                    </g>
                </svg>

                EDIT
            </button>
        </a>

        <div class="container mx-auto px-4 py-8 overflow-auto">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex flex-wrap justify-start items-center">
                            <div class="mx-2 font-base text-lg bg-red-400 px-2 py-1 rounded">{{ $task->id }}</div>
                            <div class="mx-2 font-semibold text-lg text-gray-800">{{ $task->title }}</div>
                        </div>
                        <!-- <div class="text-gray-800 text-xl font-semibold">{{ $task->title }}</div> -->
                        <div class="text-gray-600 text-sm">{{ $task->created_at }}</div>
                    </div>



                    <div class="text-gray-600 text-base mb-4">{{ $task->description }}</div>

                    <div class="flex flex-wrap justify-start items-center ">
                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Status:</span>
                            <span @class([ "text-sm font-semibold" , 'text-red-700'=> $task->state === 'Removed',
                                'text-yellow-400' => $task->state === 'In Progress',
                                'text-purple-500' => $task->state === 'Pending',
                                'text-green-700' => $task->state === 'Completed',

                                ])


                                >{{ $task->state }}</span>
                        </div>

                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Priority:</span>

                            <span @class([ "text-sm font-semibold" , 'text-red-600 '=> $task->priority === 'High',
                                'text-purple-600 ' => $task->priority === 'Medium',
                                'text-green-500 ' => $task->priority === 'Low',

                                ])
                                >

                                {{ $task->priority }}</span>
                        </div>


                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Type:</span>
                            <span @class([ "text-sm font-semibold" , 'text-red-600 '=> $task->type === 'Bug',
                                'text-purple-600 ' => $task->type === 'Test Case',
                                'text-orange-500 ' => $task->type === 'Issue',
                                'text-green-500 ' => $task->type === 'Feature',

                                ])
                                >
                                {{ $task->type }}

                            </span>
                        </div>



                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Due date:</span>
                            <span class="text-green-600 text-sm font-semibold">
                                {{ $task->target_date }}


                            </span>
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-start items-center ">
                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Risk:</span>
                            <span @class([ "text-sm font-semibold" , 'text-red-600 '=> $task->risk === 'High',
                                'text-purple-600 ' => $task->risk === 'Medium',
                                'text-green-500 ' => $task->risk === 'Low',

                                ])
                                >
                                {{ $task->risk }}

                            </span>
                        </div>
                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Effort:</span>

                            <span @class([ "text-sm font-semibold" , 'text-red-600 '=> $task->effort > 20 ,
                                'text-purple-600 ' => $task->effort <= 20 && $task->effort > 10,
                                    'text-green-500 ' => $task->effort <= 10, ])>

                                        {{ $task->effort }} Hours

                            </span>

                        </div>
                        @if($task->time_spent != null)
                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Time Spent:</span>

                            <span @class([ "text-sm font-semibold" , 'text-red-600 '=> $task->effort < $task->time_spent,
                                    'text-green-500 ' => $task->effort > $task->time_spent, ])>

                                    {{ $task->time_spent }} Hours

                            </span>
                        </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap justify-start items-center mb-4">

                        @if($task->commited_date != null)
                        <div class="mr-4 mb-2"><span class="text-gray-600 text-sm">Commited At:</span>

                            <span @class([ "text-sm font-semibold" , 'text-purple-600 '=> $task->effort < $task->time_spent,
                                    'text-green-500 ' => $task->effort > $task->time_spent, ])>

                                    {{ $task->commited_date }}

                            </span>
                        </div>
                        @endif
                    </div>



                    <div class="flex justify-start items-center mb-4">
                        <div class="mr-4"><span class="text-gray-600 text-sm">Assigned to:</span></div>
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="object-cover w-full h-full rounded-full" src="{{ $task->pro_pic }}" alt="" loading="lazy" />
                        </div>
                        <div class="ml-4">
                            <div class="text-gray-800 text-sm font-medium">{{ $task->employee_name }}</div>
                            <div class="text-gray-600 text-xs">{{ $task->employee_role }}</div>
                        </div>
                    </div>
                    @if(auth()->user()->id == $task->assigned_to && $task->state != 'Completed')

                        @if($task->state == 'Pending')
                            <form class="flex flex-wrap justify-start items-center mb-4" method="POST" action="{{ route('tasks.start',['id' => $project_id, 't_id' => $task->id]) }}">
                                @csrf

                                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg ">Start Working</button>
                            </form>
                        @else
                            <form class="flex flex-wrap justify-start items-center mb-4" method="POST" action="{{ route('tasks.commit',['id' => $project_id, 't_id' => $task->id]) }}">
                                @csrf
                                <div class="mx-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="hours_spent" name="hours_spent" type="number" placeholder="Enter Hours spent" value="{{ old('hours_spent') }}">

                                    @if($errors->has('hours_spent'))
                                    <p class="text-red-500 text-xs italic">{{ $errors->first('hours_spent') }}</p>
                                    @endif

                                </div>
                                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg ">Commit</button>
                            </form>
                        @endif
                    @endif
                </div>
                <hr class="my-6">
                <div class="flex flex-col">
                    <div class="flex flex-row items-center mx-2 my-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3v-3h5a2 2 0 002-2zM5.5 7A1.5 1.5 0 017 8.5h6A1.5 1.5 0 0114.5 7a1.5 1.5 0 00-3 .144A1.5 1.5 0 01 9 7 h - 3 A 1 . 5 1 . 5 0 00 5 . 5 7 z" clip-rule="evenodd"></path>
                        </svg>
                        Discussions {{ count($discussions) }}
                    </div>

                    <div class="overflow-auto h-64">

                        @foreach($discussions as $discuss)

                        <div @class([ "flex justify-start items-start mb-1" , 'mb-4'=> auth()->user()->id != $discuss->user_id,

                            ])>
                            <div class="flex-shrink-0 h-8 w-8">
                                <img class="object-cover w-full h-full rounded-full" src="{{$discuss->pro_pic}}" alt="" loading="lazy" />
                            </div>
                            <div class="ml-4 bg-gray-100 rounded-lg p-4 w-full">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="text-gray-800 text-sm font-medium">{{ $discuss->username }}</div>
                                    <div class="text-gray-600 text-xs">{{ $discuss->created_at }}</div>
                                </div>
                                <p class="text-gray-600 text-sm">{{ $discuss->content }}</p>
                            </div>
                        </div>
                        <div class="ml-8">
                            @if(auth()->user()->id == $discuss->user_id)
                            <form action="{{ route('discussion.delete', $discuss->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-xs hover:text-red-700 font-bold py-2 px-4 rounded">Delete</button>
                            </form>

                            @endif
                        </div>

                        @endforeach

                    </div>


                    <form action="{{ route('tasks.addDiscussion',['id' => $project_id, 't_id' => $task->id]) }}" method="POST" class="flex justify-start flex-col items-start mt-4">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <textarea name="content" id="" cols="" rows="" placeholder="Write a reply..." required class="resize-none border rounded-lg py-2 px-4 mr-2 w-full focus:outline-none focus:border-purple-500"></textarea>
                        <button type="submit" class="my-2 bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">Submit</button>
                    </form>
                </div>
            </div>
        </div>



    </div>


</x-layout>