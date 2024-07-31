<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\employees;
use App\Models\AddworkesEmployee;
use App\Models\EmployeeImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\AddProjects;




class UsersController extends Controller
{

    public function usersLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $userDepartment = Auth::user()->userDepartment;

            if (in_array($userDepartment, ['Delivery', 'Marketing', 'Business', 'HR', 'Business Admin'])) {
                $employeeId = Auth::user()->employee_Id;
                $usersImageCheck = EmployeeImage::where('employee_Id', $employeeId)->first();

                if ($usersImageCheck === null) {
                    $request->session()->flash('update_image', true);
                }

                return redirect('/user/dashboard');
            }
        } else {
            return redirect()->route('loginpage')->with('error', 'Invalid email or password');
        }
    }


    public function dashboard(Request $request)
    {
        // dd(Auth::user());
        $usersDetails = Auth::user()->employee_Id;
        $employeeDetailsId = $usersDetails;
        $usersImageCheck = EmployeeImage::where('employee_Id', $usersDetails)->first();
        $usersImage = $usersImageCheck ? $usersImageCheck->imageName : null;
        Session::put('usersImage', $usersImage);

        $employeeDetails = employees::where('id', $usersDetails)->first();
        $usersDetailsGet = \App\Models\addworkesEmployee::where('employee_Id', $usersDetails)->with('project')->paginate(10);
        $projectIds = $usersDetailsGet->pluck('project_id');

        $projectManagersName = [];

        foreach ($projectIds as $projectId) {
            $projectManagers = \App\Models\addworkesEmployee::where('project_id', $projectId)
                ->where('userDesignation', 'Project Manager')
                ->get();
            $projectManagerEmployeeIds = $projectManagers->pluck('employee_Id');
            $projectManagersData =
                User::whereIn('employee_Id', $projectManagerEmployeeIds)->get();

            $projectManagerNames = $projectManagersData->pluck('name')->implode(', ');

            $projectManagersName[$projectId] = $projectManagerNames;
        }

        return view('users.usersDashboard', compact('usersDetailsGet', 'projectManagersName'));
    }
    
    public function userView()
    {
        $usersDetails = Auth::user()->employee_Id;
        $usersImageCheck = EmployeeImage::where('employee_Id', $usersDetails)->first();
        $usersImage = $usersImageCheck ? $usersImageCheck->imageName : null;

        $employeeDetails = employees::where('id', $usersDetails)->first();
        return view('users.usersProfile', compact('employeeDetails', 'usersImage'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'employeeImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('employeeImage')) {
            $image = $request->file('employeeImage');
            $employeeId = auth()->user()->employee_Id;
            $imageName = $employeeId . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('usersImage'), $imageName);

            $employeeImage = new EmployeeImage();
            $employeeImage->employee_Id = $employeeId;
            $employeeImage->imageName = $imageName;
            $employeeImage->save();

            return redirect('/user/dashboard')->with('success', 'Image uploaded successfully!');
        } else {
            return redirect('/user/dashboard')->with('error', 'Image upload failed!');
        }
    }
}
