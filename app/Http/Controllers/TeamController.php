<?php

namespace App\Http\Controllers;

use App\Models\ProfilePic;
use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class TeamController extends Controller
{
    //
    public function list(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $has_write_permission = false;

            if (Gate::allows('update-db')) {
                $has_write_permission = true;
            }

            $project = Project::findOrFail($id);

            $proj_name = $project->project_name;
            $employees = Team::select('member_id', 'project_id', 'employee_id', 'role', 'is_active', 'created_at')->where('project_id', '=', $id)->paginate(10);
            

            foreach ($employees as $emp) {
                $user = User::findOrFail($emp->employee_id);
                $emp->employee_name = $user->name;
                $emp->email = $user->email;

                $profilePicUrl = ProfilePic::where('user_id', $emp->employee_id)->first();
                if($profilePicUrl)
                {
                    $emp->pro_pic = asset('storage/' . $profilePicUrl->pic);
                }
                else{
                    $emp->pro_pic = "https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ";
                }
                
            }

            return view('Team.list', [
                'session' => $request->session()->all(), "employees" => $employees,
                'header' => $proj_name, "proj_id" => $id, 'has_write_permission' => $has_write_permission
            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function form(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);
            $proj_name = $project->project_name;
            $adminRole = Role::where('role', 'admin')->first();

            $roles = [
                'Business Analyst', 'Developer', 'Systems Analyst', ' QA Engineer', 'DBA', 'UX/UI Designer',
                'Security Specialist', 'Technical Writer'
            ];

            $members = [];
            if ($adminRole) {
                $adminRoleId = $adminRole->id;

                $members = User::where('role', '!=', $adminRoleId)
                    ->orderBy('name')
                    ->get();
            }

            foreach ($members as $emp) {
                $role = Role::findOrFail($emp->role);
                $emp->role = $role->role;
            }


            return view('Team.add', [
                'session' => $request->session()->all(),
                'roles' => $roles,
                'proj_name' => $proj_name,
                'proj_id' => $id,
                'members' => $members

            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function store(Request $request, $id)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [
                'member' => 'required|numeric',
                'role' => 'required|string'

            ]);

            if ($validator->fails()) {
                return redirect(route('members.form', $id))
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();


            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }

            try {
                $new_member = Team::create([
                    'project_id' => $id,
                    'employee_id' => $payload["member"],
                    'role' => $payload["role"]

                ]);
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Add Member");
            }


            return back()->with("success", "The Member Added Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function edit(Request $request, $id, $m_id)
    {
        if (Auth::check()) {
            // The user is logged in...
            $project = Project::findOrFail($id);
            $adminRole = Role::where('role', 'admin')->first();

            $proj_name = $project->project_name;
            $roles = [
                'Business Analyst', 'Developer', 'Systems Analyst', ' QA Engineer', 'DBA', 'UX/UI Designer',
                'Security Specialist', 'Technical Writer'
            ];

            $members = [];
            if ($adminRole) {
                $adminRoleId = $adminRole->id;


                $members = User::where('role', '!=', $adminRoleId)
                    ->orderBy('name')
                    ->get();
            }


            foreach ($members as $emp) {
                $role = Role::findOrFail($emp->role);
                $emp->role = $role->role;
            }

            $curr_member = Team::findOrFail($m_id);

            $curr_member->member_name = User::findOrFail($curr_member->employee_id)->name;

            return view('Team.edit', [
                'session' => $request->session()->all(),
                'roles' => $roles,
                'proj_name' => $proj_name,
                'proj_id' => $id,
                'curr_member' => $curr_member

            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function update(Request $request, $id, $m_id)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [
                'status' => 'required|numeric',
                'role' => 'required|string'

            ]);

            if ($validator->fails()) {
                return redirect(route('members.edit', ['id' => $id, 'm_id' => $m_id]))
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();


            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }

            $member = Team::findOrFail($m_id);
            try {

                $member->is_active = $payload['status'];
                $member->role = $payload['role'];

                $member->save();
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Update Member | " . $ex);
            }


            return back()->with("success", "The Member Updated Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            // Find the item by ID
            $item = Team::findOrFail($id);

            // Delete the item
            $item->delete();

            // Redirect or return a response
            // For example, redirect back to the previous page
            return redirect()->back()->with('success', 'Member deleted successfully.');
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }
}
