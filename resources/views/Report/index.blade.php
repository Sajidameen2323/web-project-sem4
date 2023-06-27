<x-layout>

    <x-project_layout :title="$title" :project_id="$project_id">

        <div class="container mx-auto py-8">
            <h1 class="text-2xl text-gray-800 font-bold mb-4">Report Generation</h1>
            <div class="grid md:grid-cols-2 grid-cols-1 gap-x-2">
                <div class=" my-2">
                    <div class="bg-gray-700 p-6 rounded shadow">
                        <h2 class="text-xl text-gray-200 font-bold mb-4">Project Status Report</h2>
                        <p class="text-gray-300">A Project Status Report is a brief summary that outlines the current progress, achievements, and challenges of a project. It provides stakeholders with key updates and insights to help them assess the project's status and make informed decisions.</p>
                        <a href="{{ route('project.report.status',$project_id) }}">
                            <button class="mt-4 bg-purple-500 hover:bg-purple-600 text-gray-200 font-bold py-2 px-4 rounded">Generate
                                Report</button>
                        </a>
                    </div>
                </div>
                <div class=" my-2">
                    <div class="bg-gray-700 p-6 rounded shadow">
                        <h2 class="text-xl text-gray-200 font-bold mb-4">Gantt Chart</h2>
                        <p class="text-gray-300">
                            A Gantt Chart is a visual representation that illustrates project tasks, timelines, and dependencies in a horizontal bar chart format. It helps project managers and team members track progress, manage resources, and identify critical project milestones and deadlines.</p>
                        <a href="{{ route('project.report.gantt',$project_id) }}">
                            <button class="mt-4 bg-purple-500 hover:bg-purple-600 text-gray-200 font-bold py-2 px-4 rounded">Generate
                                Report</button>
                        </a>

                    </div>
                </div>
                <div class=" my-2">
                    <div class="bg-gray-700 p-6 rounded shadow">
                        <h2 class="text-xl text-gray-200 font-bold mb-4">Task Progress Report</h2>
                        <p class="text-gray-300">A Task Progress Report is a concise document that provides an update on the completion status of individual tasks within a project. It highlights the progress made, any delays or issues encountered, and helps in monitoring and managing task-level performance.</p>
                        
                        <a href="{{ route('project.report.progress',$project_id) }}">
                        <button class="mt-4 bg-purple-500 hover:bg-purple-600 text-gray-200 font-bold py-2 px-4 rounded">Generate
                            Report</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </x-project_layout>
</x-layout>