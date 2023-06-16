<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Integer;

class EmployeeController extends Controller
{
    //
    public function list(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...

            $employees = User::select('id', 'name', 'email', 'role', 'created_at')->paginate(10);

            foreach ($employees as $emp) {
                $role = Role::findOrFail($emp->role);
                $emp->role = $role->role;
            }

            return view('Employee.list', ['session' => $request->session()->all(), "employees" => $employees]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function form(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...

            $roles = Role::all();

            return view('Employee.add', [
                'session' => $request->session()->all(),
                'roles' => $roles

            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function store(Request $request)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'role' => 'required|numeric'

            ]);

            if ($validator->fails()) {
                return redirect('employees/add')
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
                $new_emp = User::create([
                    'name' => $payload["name"],
                    'email' => $payload["email"],
                    'password' => Hash::make($payload["password"]),
                    'role' => $payload["role"]

                ]);
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Register Employee | Email Already Registered");
            }


            return back()->with("success", "The Employee Registered Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            // Find the item by ID
            $item = User::findOrFail($id);

            // Delete the item
            $item->delete();

            // Redirect or return a response
            // For example, redirect back to the previous page
            return redirect()->back()->with('success', 'User deleted successfully.');
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function edit(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...

            $employee = User::findOrFail($id);
            $roles = Role::all();

            return view('Employee.edit', [
                'session' => $request->session()->all(),
                'employee' => $employee,
                'roles' => $roles

            ]);
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            // The user is logged in...

            $employee = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'role' => 'required|numeric'

            ]);

            if ($validator->fails()) {
                return redirect('employees/add')
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
            $employee->name = $payload['name'];
            $employee->email = $payload['email'];
            $employee->role = $payload['role'];

            $employee->save();

            return back()->with("success", "The Employee Updated Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }
}
