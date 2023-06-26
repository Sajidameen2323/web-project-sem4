<x-layout>
    <script type="text/javascript">
        var data = {{ Js::from($active_projs) }};

        console.log(data);
    </script>
    <div class="flex flex-col items-stretch ">

        <!-- Main Content -->
        <div class="flex-grow p-8">
            <div class="bg-gray-700 rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-xl text-gray-200 font-bold mb-4">Project Overview</h2>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-400">Total Projects</p>
                        <p class="text-3xl font-bold text-gray-300">{{$tot_projs}}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Completed Projects</p>
                        <p class="text-3xl text-gray-300 font-bold">{{$comp_projs}}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Ongoing Projects</p>
                        <p class="text-3xl text-gray-300 font-bold">{{$curr_projs}}</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($active_projs as $proj)
                <!-- Project Card (Dummy Data) -->
                <div class="bg-gray-700 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg text-gray-300 font-bold mb-4">{{$proj->project_name}}</h3>
                    <p class="text-gray-400">Status: In Progress</p>
                    <p class="text-gray-400 mt-2">Tasks: {{$proj->tot_tasks}}</p>
                    <p class="text-gray-400">Team Members: {{$proj->tot_members}}</p>
                </div>
            @endforeach
            </div>
            <div class="bg-gray-700  rounded-lg shadow-lg p-6 mb-8 mt-6">
                <h2 class="text-xl text-gray-300 font-bold mb-4">Project Overview</h2>
                {!! $chart->container() !!}
                {!! $chart->script() !!}
            </div>



</x-layout>