<?php

namespace App\Http\Controllers;

use App\Models\Commit;
use App\Models\Discussion;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //

    public function list(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);

            $filterValue = $request->input('filter');

            if ($filterValue) {
                $query = Task::select('id', 'title', 'state', 'assigned_to', 'type', 'created_at')
                    ->where('project_id', '=', $id)
                    ->where('state', $filterValue);
            } else {

                $query = Task::select('id', 'title', 'state', 'assigned_to', 'type', 'created_at')
                    ->where('project_id', '=', $id);
            }

            $tasks = $query->paginate(10);

            foreach ($tasks as $task) {
                $user = User::findOrFail($task->assigned_to);
                $task->employee_name = $user->name;
                $task->email = $user->email;

                $member_role = Team::select('role')
                    ->where('project_id', $id)
                    ->where('employee_id', $task->assigned_to)
                    ->first();

                $task->employee_role = $member_role->role;
            }

            return view('Task.index', [
                'session' => $request->session()->all(),
                'tasks' => $tasks,
                'project_id' => $id,
                'title' => 'Tasks',
                'filterValue' => $filterValue
            ]);
        }

        return view('Auth.login', ['data' => 'Please Login!']);
    }
    public function form(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);

            $states = ['Pending', 'In Progress', 'Completed', 'Removed'];
            $priorities = ['Low', 'Medium', 'High'];
            $types = ['Bug', 'Feature', 'Issue', 'Test Case'];
            $proj_members = Team::select('employee_id', 'role')
                ->where('project_id', $id)
                ->where('is_active', 1)
                ->get();

            foreach ($proj_members as $member) {
                $usr = User::findOrFail($member->employee_id);
                $member->name = $usr->name;
            }

            return view('Task.add', [
                'session' => $request->session()->all(),
                'project_id' => $id,
                'title' => 'Add Tasks',
                'states' => $states,
                'priorities' => $priorities,
                'types' => $types,
                'proj_members' => $proj_members
            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function store(Request $request, $id)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'state' => 'required|string',
                'description' => 'required|string',
                'assigned_to' => 'required|numeric',
                'priority' => 'required|string',
                'effort' => 'required|numeric',
                'target_date' => 'required|date',
                'risk' => 'required|string',
                'type' => 'required|string',

            ]);

            if ($validator->fails()) {
                return redirect(route('tasks.form', $id))
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();


            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }
            $payload['project_id'] = $id;

            try {
                $new_task = Task::create($payload);
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Add Task");
            }

            return back()->with("success", "The Task Added Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            // Find the item by ID
            $item = Task::findOrFail($id);

            // Delete the item
            $item->delete();

            // Redirect or return a response
            // For example, redirect back to the previous page
            return redirect()->back()->with('success', 'Task deleted successfully.');
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function edit(Request $request, $id, $t_id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);
            $task = Task::findOrFail($t_id);

            $states = ['Pending', 'In Progress', 'Completed', 'Removed'];
            $priorities = ['Low', 'Medium', 'High'];
            $types = ['Bug', 'Feature', 'Issue', 'Test Case'];
            $proj_members = Team::select('employee_id', 'role')
                ->where('project_id', $id)
                ->where('is_active', 1)
                ->get();

            foreach ($proj_members as $member) {
                $usr = User::findOrFail($member->employee_id);
                $member->name = $usr->name;
            }

            return view('Task.edit', [
                'session' => $request->session()->all(),
                'project_id' => $id,
                'title' => 'Add Tasks',
                'states' => $states,
                'priorities' => $priorities,
                'types' => $types,
                'proj_members' => $proj_members,
                'task' => $task
            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function update(Request $request, $id, $t_id)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [

                'title' => 'required|string',
                'state' => 'required|string',
                'description' => 'required|string',
                'assigned_to' => 'required|numeric',
                'priority' => 'required|string',
                'effort' => 'required|numeric',
                'target_date' => 'required|date',
                'risk' => 'required|string',
                'type' => 'required|string',

            ]);

            if ($validator->fails()) {
                return redirect(route('Task.edit', ['id' => $id, 'm_id' => $t_id]))
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();


            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }

            $task = Task::findOrFail($t_id);
            try {

                $task->title = $payload['title'];
                $task->state = $payload['state'];
                $task->description = $payload['description'];
                $task->assigned_to = $payload['assigned_to'];
                $task->priority = $payload['priority'];
                $task->effort = $payload['effort'];
                $task->target_date = $payload['target_date'];
                $task->risk = $payload['risk'];
                $task->type = $payload['type'];

                $task->save();
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Update Task | " . $ex);
            }


            return back()->with("success", "The Task Updated Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function viewTask(Request $request, $id, $t_id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);
            $task = Task::findOrFail($t_id);

            $discussions = Discussion::where('task_id', $t_id)->get();

            $user = User::findOrFail($task->assigned_to);
            $task->employee_name = $user->name;
            $task->email = $user->email;

            foreach ($discussions as $discuss) {
                $commentor = User::findOrFail($discuss->user_id);
                $discuss->username = $commentor->name;
            }

            $member_role = Team::select('role')
                ->where('project_id', $id)
                ->where('employee_id', $task->assigned_to)
                ->first();

            $task->employee_role = $member_role->role;

            $task->comments_count = 12;

            $task->time_spent = null;
            $task->commited_date = null;
            try {
                $commit = Commit::where('task_id', $task->id)->first();
                $task->time_spent = $commit->hours_spent;
                $task->commited_date = $commit->created_at;
            } catch (Exception $ex) {

                error_log("Could Not Update Task | " . $ex);
                $task->time_spent = null;
                $task->commited_date = null;
            }

            return view('Task.details', [
                'session' => $request->session()->all(),
                'task' => $task,
                'project_id' => $id,
                'title' => 'Tasks',
                'discussions' => $discussions

            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function addDiscussion(Request $request, $id, $t_id)
    {
        if (Auth::check()) {



            $validator = Validator::make($request->all(), [

                'content' => 'required|string',


            ]);

            if ($validator->fails()) {
                return redirect(route('tasks.view', ['id' => $id, 't_id' => $t_id]))
                    ->withErrors($validator)
                    ->withInput();
            }

            // Find the item by ID
            $task = Task::findOrFail($t_id);

            $validated = $validator->validated();
            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }
            $payload['task_id'] = $task->id;
            $payload['user_id'] = auth()->user()->id;

            try {
                $new_disscussion = Discussion::create($payload);
                error_log("---ADDED DISCUSSION---");
            } catch (Exception $ex) {
                error_log($ex->getMessage());
                return back()->with("failed", "Could Not Add Task");
            }
            // Redirect or return a response
            // For example, redirect back to the previous page
            return redirect()->back()->with('success', 'Discussion added successfully.');
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function removeDiscussion(Request $request, $id)
    {
        if (Auth::check()) {
            // Find the item by ID
            $item = Discussion::findOrFail($id);

            // Delete the item
            $item->delete();

            // Redirect or return a response
            // For example, redirect back to the previous page
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function commitTask(Request $request, $id, $t_id)
    {
        if (Auth::check()) {

            // Find the item by ID
            $validator = Validator::make($request->all(), [
                'hours_spent' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return redirect(route('tasks.view', ['id' => $id, 't_id' => $t_id]))
                    ->withErrors($validator)
                    ->withInput();
            }

            // Find the item by ID
            $task = Task::findOrFail($t_id);

            $validated = $validator->validated();
            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }
            $payload['task_id'] = $task->id;
            $payload['project_id'] = $task->project_id;
            $payload['user_id'] = auth()->user()->id;

            try {
                $task->state = 'Completed';
                $task->save();

                $new_commit = Commit::create($payload);

                error_log("---ADDED COMMIT---");
            } catch (Exception $ex) {
                error_log($ex->getMessage());
                return back()->with("failed", "Could Not Add Commit");
            }
            // Redirect or return a response
            // For example, redirect back to the previous page
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }



    public function getMyTasks(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...

            $filterValue = $request->input('filter');

            if ($filterValue) {
                $query = Task::select('id', 'project_id', 'title', 'state', 'assigned_to', 'type', 'created_at')
                    ->where('assigned_to', '=', auth()->user()->id)
                    ->where('state', $filterValue);
            } else {

                $query = Task::select('id', 'project_id', 'title', 'state', 'assigned_to', 'type', 'created_at')
                    ->where('assigned_to', '=', auth()->user()->id);
            }

            $tasks = $query->paginate(10);

            foreach ($tasks as $task) {

                $proj_id = $task->project_id;
                $member_role = Team::select('role')
                    ->where('project_id', $proj_id)
                    ->where('employee_id', $task->assigned_to)
                    ->first();

                $task->employee_role = $member_role->role;

                $project = Project::findOrFail($proj_id);
                $task->proj_name = $project->project_name;
                $task->proj_subtitle = $project->subtitle;
            }

            return view('MyTasks.index', [
                'session' => $request->session()->all(),
                'tasks' => $tasks,
                'title' => 'Tasks',
                'filterValue' => $filterValue
            ]);
        }

        return view('Auth.login', ['data' => 'Please Login!']);
    }
}
