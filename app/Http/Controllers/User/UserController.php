<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\User\InsertUser;
use App\Models\Department\Department;
use App\Models\Designation\Designation;
use App\Models\Role\Role;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\ShiftTime\ShiftTime;
use App\Models\Team\Team;
use App\Mail\User\UserRegistrationMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

    // get all users from view_user
    public function index(Request $request)
    {
        return view('modules.user.index');
    }

    // add new user view
    public function addView()
    {

        $designations = Designation::select('id', 'name')->get();
        $departments = Department::select('id', 'name')->get();
        $shiftTimings = ShiftTime::select('id', 'name')->get();
        $roles = Role::select('id', 'name')->get();
        $teams = Team::select('id', 'name')->get();
        $supervisors = User::select('users.id as id', 'users.first_name as name')
            ->whereHas('role', function ($query) {
                $query->where('slug', 'supervisor');
            })->get();
        return view('modules.user.add', compact('designations', 'departments', 'shiftTimings', 'roles', 'teams', 'supervisors'));
    }

    // insert user into database and redirect to edit page
    public function insertInDatabase(InsertUser $request)
    {

        $password = Str::random(12) . '-' . Helper::randomNumber();
        $user = User::userCreate($request, $password);

        $user->teams()->sync($request->team_ids);

        $this->sendPasswordEmail($user, $password);

        Toastr::success('User has been Added Successfully! <small>You can edit your profile detail here</small>', 'Success');
        return redirect()->route('user.update-user', $user->id);
    }

    // send password in email
    private function sendPasswordEmail($user, $random_password)
    {

        Mail::to($user->email)->send(new UserRegistrationMail($user, $random_password));
    }

    // edit user view
    public function edit($id)
    {

        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $userId = $id;
        return view('modules.user.edit', compact('userId'));
    }

    public function security(Request $request)
    {
        $user = Auth::user();
        return view('modules.user.security.security', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validated->fails()) {
            Toastr::error($validated->errors()->first(), 'Error');
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            Toastr::error('Current Password is not correct', 'Error');
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        // update password
        $user = User::find($user->id);
        $user->password = Hash::make($request->password);
        $user->save();

        Toastr::success('Password has been changed successfully', 'Success');
        return redirect()->back();
    }
}
