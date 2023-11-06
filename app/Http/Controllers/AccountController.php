<?php

namespace App\Http\Controllers;

use App\Models\ProfilePic;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //
    public function index(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...
            $role = Role::select('role')->where('id', auth()->user()->role)->first();
            $profilePicUrl = ProfilePic::where('user_id', auth()->user()->id)->first();

            if ($profilePicUrl) {
                $pro_pic = asset('/' . $profilePicUrl->pic);
            } else {
                $pro_pic = "https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ";
            }


            return view('User.settings', [
                'Remembered' => false,
                'session' => $request->session()->all(),
                'role' => $role,
                'pro_pic' => $pro_pic

            ]);
        }

        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function updateName(Request $request)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [

                'name' => 'required|string',

            ]);

            if ($validator->fails()) {
                return redirect(route('settings'))
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();


            $payload = [];

            foreach ($validated as $x => $val) {
                // error_log("$x = $val");
                $payload[$x] = $val;
            }

            $user = User::findOrFail(auth()->user()->id);
            try {

                $user->name = $payload['name'];

                $user->save();
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Update User | " . $ex);
            }


            return back()->with("success", "The User Details Updated Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }

    public function updateProfilePic(Request $request)
    {
        if (Auth::check()) {


            $validator = Validator::make($request->all(), [
                'pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect(route('settings'))
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            $user = User::findOrFail(auth()->user()->id);
            try {


                $prev_pic = ProfilePic::where('user_id', $user->id)->first();

                $picPath = $request->file('pic')->store('profile_pics', 'public');

                if ($prev_pic) {
                    $prev_pic->pic = $picPath;
                    $prev_pic->save();
                } else {
                    ProfilePic::create([
                        'pic' => $picPath,
                        'user_id' => $user->id,
                    ]);
                }
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Update Profile Pic | " . $ex);
            }


            return back()->with("success", "Profile Pic Updated Successfully");
        }
        return view('Auth.login', ['data' => 'Please Login!']);
    }


    public function updatePassword(Request $request)
    {

        if (Auth::check()) {

            // Validate the request data

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);

            if ($validator->fails()) {
                return redirect(route('settings'))
                    ->withErrors($validator)
                    ->withInput();
            }
            // Get the authenticated user
            $user = User::where('id', auth()->user()->id)->first();

            // Verify the current password
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect']);
            }

            try {

                // Update the password
                $user->password = Hash::make($request->new_password);
                $user->save();
            } catch (Exception $ex) {

                return back()->with("failed", "Could Not Update Password | " . $ex);
            }

            return back()->with('success', 'Password updated successfully');
        } else {

            return view('Auth.login', ['data' => 'Please Login!']);
        }
    }

    public function getProfilePic(Request $request)
    {
        // Retrieve the profile picture URL from the authenticated user or any other logic
        $profilePicUrl = ProfilePic::where('user_id', auth()->user()->id)->first();

        if ($profilePicUrl) {
            $pro_pic = asset('storage/' . $profilePicUrl->pic);
        } else {
            $pro_pic = "https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ";
        }
        // Return the profile picture URL in JSON format
        return response()->json([
            'profile_pic_url' => $pro_pic
        ]);
    }
}
