<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //
    public function chart()
    {
        $projects = Project::all();
        $projectCounts = $projects->countBy('status')->toArray();

        $labels = [];
        $data = [];

        // Prepare the data for the chart
        foreach ($projectCounts as $status => $count) {
            $labels[] = $status;
            $data[] = $count;
        }

        // Return the chart data as JSON
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function gantt(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);



            $tasks = Task::select('id', 'title', 'state', 'assigned_to', 'type', 'created_at', 'target_date')
                ->where('project_id', '=', $id)->get();

            foreach ($tasks as $task) {
                $user = User::withTrashed()->findOrFail($task->assigned_to);
                $task->employee_name = $user->name;
                $task->email = $user->email;

                $member_role = Team::select('role')
                    ->where('project_id', $id)
                    ->where('employee_id', $task->assigned_to)
                    ->first();

                $task->employee_role = $member_role->role;
            }

            return view('Report.gantt', [
                'session' => $request->session()->all(),
                'tasks' => $tasks,
                'project_id' => $id,
                'title' => 'Tasks',

            ]);
        }

        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function projectStatus(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $tasks = Task::select('state', DB::raw('count(*) as total'))
                ->where('project_id', '=', $id)
                ->groupBy('state')
                ->get();

            return view('Report.status', [
                'session' => $request->session()->all(),
                'project_id' => $id,
                'title' => 'Tasks',
                'tasks' => $tasks

            ]);
        }

        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function taskProgress(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);



            $tasks = Task::select('id', 'title', 'state', 'assigned_to', 'type', 'created_at', 'target_date')
                ->where('project_id', '=', $id)->get();

            foreach ($tasks as $task) {
                $user = User::withTrashed()->findOrFail($task->assigned_to);
                $task->employee_name = $user->name;
                $task->email = $user->email;

                $member_role = Team::select('role')
                    ->where('project_id', $id)
                    ->where('employee_id', $task->assigned_to)
                    ->first();

                $task->employee_role = $member_role->role;
            }

            return view('Report.progress', [
                'session' => $request->session()->all(),
                'tasks' => $tasks,
                'project_id' => $id,
                'title' => 'Tasks',

            ]);
        }

        return view('Auth.login', ['data' => 'Please Login!']);
    }


}
