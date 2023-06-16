<?php

namespace App\Http\Controllers;

use App\Models\Project;
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

            $projs = Project::paginate(8);


            return view('Project.index', ['session' => $request->session()->all(), "projects" => $projs]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }
    public function form(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...


            $employees = User::select('id', 'name')->where('role', 2)->get();

            $frontend_arr = ['React', 'Vue', 'Next', 'Angular', 'Windows', 'Svelte'];

            $backend_arr = ['Spring', 'Next.js', 'ASP.NET', 'Flask', 'Django', 'Express'];

            $db_arr = ['Oracle', 'MySQL', 'MS SQL Server', 'PostgreSQL', 'MongoDB', 'Redis', 'Firestore'];

            return view('Project.add', [
                'session' => $request->session()->all(),
                "managers" => $employees, "seniors" => $employees, 'frontend_arr' => $frontend_arr, 'backend_arr' => $backend_arr,
                'db_arr' => $db_arr
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

            // Redirect or return a response
            // For example, redirect back to the previous page
            return view('Project.overview', [
                'data' => $item, 'project_manager' => $project_manager->name,
                'team_lead' => $team_lead->name
            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function edit(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...

            $project = Project::findOrFail($id);


            $employees = User::select('id', 'name')->where('role', 2)->get();

            $frontend_arr = ['React', 'Vue', 'Next', 'Angular', 'Windows', 'Svelte'];

            $backend_arr = ['Spring', 'Next.js', 'ASP.NET', 'Flask', 'Django', 'Express'];

            $db_arr = ['Oracle', 'MySQL', 'MS SQL Server', 'PostgreSQL', 'MongoDB', 'Redis', 'Firestore'];

            return view('Project.edit', [
                'session' => $request->session()->all(),
                "managers" => $employees, "seniors" => $employees, 'frontend_arr' => $frontend_arr, 'backend_arr' => $backend_arr,
                'db_arr' => $db_arr,
                'project' => $project
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
                return redirect('projects/edit/'.$id)
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
}
