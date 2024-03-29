<x-layout>
    <x-project_layout :title="2" :project_id="$proj_id">
        <div class="grid md:grid-cols-6 mb-2">
            <div class="md:col-span-5">

            </div>


            @if($write_permission)
            <a href="{{ route('members.form', $proj_id) }}">
                <button class="bg-green-500 text-sm hover:bg-green-700 text-white px-4 py-2 rounded mt-4 mx-6 md:mx-0">
                    ADD MEMBER
                </button>
            </a>
            @endif



        </div>

        <div class="container grid px-6 mx-auto">
            <!-- With actions -->

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Employee</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Added Date</th>
                                @if($write_permission)
                                <th class="px-4 py-3">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            @foreach($employees as $employee)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar with inset shadow -->
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            <img class="object-cover w-full h-full rounded-full" src="{{ $employee->pro_pic }}" alt="" loading="lazy" />
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $employee->employee_name }}</p>
                                            <p class="font-base text-xs">{{ $employee->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $employee->role }}
                                </td>
                                <td class="px-4 py-3 text-xs">

                                    @if ($employee->is_active === 1)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                    @endif

                                </td>
                                <td class="px-4 py-3 text-sm">

                                    <?php
                                    $date = new DateTime($employee->created_at);
                                    $formattedDate = $date->format("Y-m-d");
                                    echo $formattedDate;
                                    ?>

                                </td>
                                @if($write_permission)
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">

                                        <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" href="{{ route('members.edit', ['id' => $proj_id, 'm_id' => $employee->member_id]) }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <a class="cursor-pointer flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" onclick="event.preventDefault();
                                            if (confirm('Are you sure you want to delete this item?')) {
                                                document.getElementById('delete-form-{{ $employee->member_id }}').submit();
                                            }">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>

                                        <form id="delete-form-{{$employee->member_id}}" action="{{ route('members.delete',$employee->member_id) }}" method="POST" style="display: none;">
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
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <span class="flex items-center col-span-3">

                    </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                        {!! $employees->links() !!}
                        </nav>
                    </span>
                </div>
            </div>
        </div>

    </x-project_layout>
</x-layout>