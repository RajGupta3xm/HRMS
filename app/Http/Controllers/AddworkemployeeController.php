<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\AddProjects;
use App\Models\User;
use App\Models\addworkesEmployee;
use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAllocatedToProject;



use Illuminate\Support\Facades\Redirect;

use Collective\Html\FormFacade as Form;


class AddworkemployeeController extends Controller
{
    public function addWorksEmployee($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $projectData = AddProjects::find($id);
        if (Auth::user()->status == 0) {

            if ($projectData) {
                $addworkesEmployees = addworkesEmployee::where('project_id', $projectData->id)->paginate(10);
                $employeeIds = $addworkesEmployees->pluck('employee_Id')->toArray();
                $usersDetails = employees::whereIn('id', $employeeIds)->pluck('name', 'id');
                return view('addWorkEmployee', [
                    'modules' => $modules,
                    'projectData' => $projectData,
                    'addworkesEmployees' => $addworkesEmployees,
                    'usersDetails' => $usersDetails
                ]);
            }
        }
        elseif(Auth::user()->status == 1){
            if ($projectData) {
                $addworkesEmployees = addworkesEmployee::where('project_id', $projectData->id)->paginate(10);
                $employeeIds = $addworkesEmployees->pluck('employee_Id')->toArray();
                $usersDetails = employees::whereIn('id', $employeeIds)->pluck('name', 'id');
                return view('users.addWorkEmployeeUser', [
                   
                    'projectData' => $projectData,
                    'addworkesEmployees' => $addworkesEmployees,
                    'usersDetails' => $usersDetails
                ]);
            }
        }
    }


    public function fetchUsersByDesignation($designation)
    {
        $users = User::where('designation', $designation)->get();
        return response()->json($users);
    }


    // public function addworkesEmployeeStore(Request $request)
    // {
    //     $employeeId = $request->input('employee_id');
    //     $addworkesEmployee = [
    //         'project_id' => $request->input('projectId'),
    //         'userDepartment' => $request->input('userDepartment'),
    //         'userDesignation' => $request->input('userDesignation'),
    //         'employee_Id' => $request->input('employee_Id'),
    //         'allocationpercentage' => $request->input('allocationpercentage'),
    //         'status' => 1,
    //         'startdate' => $request->input('startdate'),
    //         'enddate' => $request->input('enddate'),
    //     ];

    //     $existingProject = AddworkesEmployee::find($employeeId);

    //     if ($existingProject) {
    //         $newTotalAllocation = $request->input('allocationpercentage');

    //         $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))
    //             ->where('id', '!=', $employeeId)
    //             ->sum('allocationpercentage');

    //         $newTotalAllocation += $totalAllocation;

    //         if ($newTotalAllocation > 100) {
    //             $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //             return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //         }

    //         $existingProject->fill($addworkesEmployee)->save();
    //         return redirect()->route('addWorksEmployee.id', ['id' => $addworkesEmployee['project_id']])->with('status', 'Employee Updated Successfully');
    //     } else {
    //         $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))->sum('allocationpercentage');
    //         $newTotalAllocation = $totalAllocation + $request->input('allocationpercentage');

    //         if ($newTotalAllocation > 100) {
    //             $errorMessage = 'Total allocation percentage for this user exceeds 100%';
    //             return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
    //         }

    //         $project = AddworkesEmployee::create($addworkesEmployee);

    //         if ($project) {
    //             return redirect()->back()->with('status', 'Employee Added Successfully');
    //         } else {
    //             return redirect()->back()->with('status', 'Failed to Create Employee');
    //         }
    //     }
    // }
    public function addworkesEmployeeStore(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $addworkesEmployee = [
            'project_id' => $request->input('projectId'),
            'userDepartment' => $request->input('userDepartment'),
            'userDesignation' => $request->input('userDesignation'),
            'employee_Id' => $request->input('employee_Id'),
            'allocationpercentage' => $request->input('allocationpercentage'),
            'status' => 1,
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
        ];
    
        $existingProject = AddworkesEmployee::find($employeeId);
    
        if ($existingProject) {
            $newTotalAllocation = $request->input('allocationpercentage');
    
            $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))
                ->where('id', '!=', $employeeId)
                ->sum('allocationpercentage');
    
            $newTotalAllocation += $totalAllocation;
    
            if ($newTotalAllocation > 100) {
                $errorMessage = 'Total allocation percentage for this user exceeds 100%';
                return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
            }
    
            $existingProject->fill($addworkesEmployee)->save();
            $project = AddProjects::find($request->input('projectId'));
            $employee = employees::where('id', $request->input('employee_Id'))->first();
            // dd($employee);
            $allocationPercentage = $request->input('allocationpercentage');
            Mail::to($employee->officialemail)->send(new UserAllocatedToProject($employee, $project, $allocationPercentage));
            return redirect()->route('addWorksEmployee.id', ['id' => $addworkesEmployee['project_id']])->with('status', 'Employee Updated Successfully');
        } else {
            $totalAllocation = AddworkesEmployee::where('employee_Id', $request->input('employee_Id'))->sum('allocationpercentage');
            $newTotalAllocation = $totalAllocation + $request->input('allocationpercentage');
    
            if ($newTotalAllocation > 100) {
                $errorMessage = 'Total allocation percentage for this user exceeds 100%';
                return redirect()->back()->withInput()->withErrors(['allocationpercentage' => $errorMessage]);
            }
    
            $project = AddworkesEmployee::create($addworkesEmployee);
    
            if ($project) {
                $project = AddProjects::find($request->input('projectId'));
                $employee = employees::where('id', $request->input('employee_Id'))->first();
                $allocationPercentage = $request->input('allocationpercentage');
                // dd($employee->email);
                Mail::to($employee->officialemail)->send(new UserAllocatedToProject($employee, $project, $allocationPercentage));
                return redirect()->back()->with('status', 'Employee Added Successfully');
            } else {
                return redirect()->back()->with('status', 'Failed to Create Employee');
            }
        }
    }
    
    public function editEmployeeWork($id)
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $employee = AddworkesEmployee::findOrFail($id);
        if(Auth::user()->status == 0){
            return view('editEmployee', ['employee' => $employee], ['modules' => $modules]);

        }elseif(Auth::user()->status == 1){
            return view('users.editEmployeeUser', ['employee' => $employee]);


        }
    }
    public function fetchEmployeeName($employeeId)
    {
        $employee = employees::find($employeeId);

        if ($employee) {
            return response()->json([
                'id' => $employee->id,
                'name' => $employee->name,
            ]);
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

    public function deleteEmployee($id)
    {
        $employee = AddworkesEmployee::find($id);

        if ($employee) {
            $employee->delete();
            Session::flash('success', 'Employee record deleted successfully.');
        } else {
            Session::flash('error', 'Failed to delete employee record.');
        }

        return redirect()->back();
    }
    public function checkAllocation(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:addworkes_employees,employee_id',
            'allocation_percentage' => 'required|numeric|between:1,100',
        ]);

        $employeeId = $validatedData['employee_id'];
        $allocationPercentage = $validatedData['allocation_percentage'];

        $currentAllocation = AddworkesEmployee::where('employee_id', $employeeId)->sum('allocationpercentage');
// dd($currentAllocation);
        if ($currentAllocation + $allocationPercentage > 100) {
            // dd('hle');
            return response()->json([
                'error' => true,
                'message' => 'Total allocation percentage for this employee exceeds 100%.',
            ]);
        }

        return response()->json([
          
            'error' => false,
            'message' => 'this user not allocation in Any projects.',
        ]);
    }
   

}
