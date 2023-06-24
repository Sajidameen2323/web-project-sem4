<?php

namespace App\Http\Controllers;

use App\Models\Commit;
use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    //


    public function projects(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...
            $filterValue = $request->input('filter');
            if ($filterValue) {
                $query = Project::where('status', $filterValue);
            } else {

                $query = Project::where('project_id', '>', '0');
            }
            $projs = $query->paginate(8);


            return view('Project.index', [
                'session' => $request->session()->all(), "projects" => $projs,
                'filterValue' => $filterValue
            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }
    public function form(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...

            $managerRole = Role::where('role', 'manager')->first();
            $managerRoleId = $managerRole->id;

            $seniorRole = Role::where('role', 'senior')->first();
            $seniorRoleId = $seniorRole->id;

            $managers = User::select('id', 'name')->where('role', $managerRoleId)->get();

            $seniors = User::select('id', 'name')->where('role', $seniorRoleId)->get();

            $frontend_arr = ['React', 'Vue', 'Next', 'Angular', 'Windows', 'Svelte'];

            $backend_arr = ['Spring', 'Next.js', 'ASP.NET', 'Flask', 'Django', 'Express'];

            $db_arr = ['Oracle', 'MySQL', 'MS SQL Server', 'PostgreSQL', 'MongoDB', 'Redis', 'Firestore'];

            $status_arr = ['Active', 'Completed', 'Dropped', 'Postponed', 'Scheduled'];

            return view('Project.add', [
                'session' => $request->session()->all(),
                "managers" => $managers, "seniors" => $seniors, 'frontend_arr' => $frontend_arr, 'backend_arr' => $backend_arr,
                'db_arr' => $db_arr,
                'status_arr' => $status_arr
            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function store(Request $request)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [
                'project_name' => 'required|string',
                'subtitle' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'project_manager' => 'required|numeric',
                'team_lead' => 'required|numeric',
                'priority' => 'required|string|max:20',
                'status' => 'required|string|max:20',
                'description' => 'required|string',
                'frontend' => 'required|string',
                'backend' => 'required|string',
                'database' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect('projects/add')
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();


            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }
            error_log("logging payload");
            error_log($payload["project_name"]);


            try {
                $new_project = Project::create([
                    'project_name' => $payload["project_name"],
                    'subtitle' => $payload["subtitle"],
                    'start_date' => $payload["start_date"],
                    'end_date' => $payload["end_date"],
                    'project_manager' => $payload["project_manager"],
                    'team_lead' => $payload["team_lead"],
                    'priority' => $payload["priority"],
                    'status' => $payload["status"],
                    'description' => $payload["description"],
                    'frontend' => $payload["frontend"],
                    'backend' => $payload["backend"],
                    'database' => $payload["database"]
                ]);
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Add Project | Check your inputs");
            }


            return back()->with("success", "The item added successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }



    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            // Find the item by ID
            $item = Project::findOrFail($id);

            // Delete the item
            $item->delete();

            // Redirect or return a response
            // For example, redirect back to the previous page
            return redirect()->back()->with('success', 'Item deleted successfully.');
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function viewProject(Request $request, $id)
    {
        if (Auth::check()) {
            // Find the item by ID
            $item = Project::findOrFail($id);

            $project_manager = User::select('name')->where('id', $item->project_manager)->first();
            $team_lead = User::select('name')->where('id', $item->team_lead)->first();
            $tasks_count = count(Task::where('project_id', $id)->get());
            $members_count = count(Team::where('project_id', $id)->get());
            $commits_count = count(Commit::where('project_id', $id)->get());
            // Redirect or return a response
            // For example, redirect back to the previous page
            return view('Project.overview', [
                'data' => $item, 'project_manager' => $project_manager->name,
                'team_lead' => $team_lead->name,
                'tot_tasks' => $tasks_count,
                'tot_members' => $members_count,
                'tot_commits' => $commits_count,
            ])->with('title', "kaham")->with('project_id', $item->project_id);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function edit(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...

            $project = Project::findOrFail($id);
            $managerRole = Role::where('role', 'manager')->first();
            $managerRoleId = $managerRole->id;

            $seniorRole = Role::where('role', 'senior')->first();
            $seniorRoleId = $seniorRole->id;

            $managers = User::select('id', 'name')->where('role', $managerRoleId)->get();

            $seniors = User::select('id', 'name')->where('role', $seniorRoleId)->get();

            $frontend_arr = ['React', 'Vue', 'Next', 'Angular', 'Windows', 'Svelte'];

            $backend_arr = ['Spring', 'Next.js', 'ASP.NET', 'Flask', 'Django', 'Express'];

            $db_arr = ['Oracle', 'MySQL', 'MS SQL Server', 'PostgreSQL', 'MongoDB', 'Redis', 'Firestore'];

            $status_arr = ['Active', 'Completed', 'Dropped', 'Postponed', 'Scheduled'];

            return view('Project.edit', [
                'session' => $request->session()->all(),
                "managers" => $managers, "seniors" => $seniors, 'frontend_arr' => $frontend_arr, 'backend_arr' => $backend_arr,
                'db_arr' => $db_arr,
                'project' => $project,
                'status_arr' => $status_arr
            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...

            $project = Project::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'project_name' => 'required|string',
                'subtitle' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'project_manager' => 'required|numeric',
                'team_lead' => 'required|numeric',
                'priority' => 'required|string|max:20',
                'status' => 'required|string|max:20',
                'description' => 'required|string',
                'frontend' => 'required|string',
                'backend' => 'required|string',
                'database' => 'required|string',

            ]);

            if ($validator->fails()) {
                return redirect('projects/edit/' . $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();
            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }
            // Update the user's details
            $project->project_name = $payload['project_name'];
            $project->subtitle = $payload['subtitle'];
            $project->start_date = $payload['start_date'];
            $project->end_date = $payload['end_date'];
            $project->project_manager = $payload['project_manager'];
            $project->team_lead = $payload['team_lead'];
            $project->priority = $payload['priority'];
            $project->status = $payload['status'];
            $project->description = $payload['description'];
            $project->frontend = $payload['frontend'];
            $project->backend = $payload['backend'];
            $project->database = $payload['database'];

            // Save the updated project
            if ($project->save()) {
                return redirect()->route('projects.edit', $id)->with('success', 'Project details updated successfully.');
            } else {
                return redirect()->back()->with('failed', 'Failed to update project details. Please try again.');
            }
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function viewReports(Request $request, $id)
    {
        if (Auth::check()) {
            // Find the item by ID
            $item = Project::findOrFail($id);


            // Redirect or return a response
            // For example, redirect back to the previous page
            return view('Report.index', [
                'data' => $item

            ])->with('title', "kaham")->with('project_id', $item->project_id);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }
}
