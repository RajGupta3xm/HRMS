<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\addworkesEmployee;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TimeSheetApproved;
use App\Mail\TimeSheetRejected;





class ApprovalTimesheetController extends Controller
{
   
    public function approvalTimesheet()
    {
        $userDetails = Auth::user()->userDesignation;
        $userLoginDetails = Auth::user()->employee_Id;

        $TotalSubmitedData = [];

        if ($userDetails === 'Project Manager') {
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)->paginate(10);
            $projectManagerAssignedProjectIds = $assignedProjects->pluck('project_id')->toArray();
            $timeEntries = TimeEntry::whereIn('project_id', $projectManagerAssignedProjectIds)
                ->with('employee', 'project', 'addworkesEmployees')->get()->toArray();

            foreach ($timeEntries as $timeEntry) {
                $timesheetId = $timeEntry['id'];
                $projectId = $timeEntry['project_id'];
                $projectSubmitedDate = $timeEntry['date'];
                $projectSubmitedStatus = $timeEntry['status'];
                $totalHours = $timeEntry['total_hours'];
                $employeeName = $timeEntry['employee']['name'];
                $projectName = $timeEntry['project']['projectname'];

                $projectManagerStatus = null;

                foreach ($timeEntry['addworkes_employees'] as $worker) {
                    if ($worker['employee_Id'] == $userLoginDetails) {
                        $projectManagerStatus = $worker['status'];
                        break;
                    }
                }

                $TotalSubmitedData[] = [
                    'timesheetId' => $timesheetId,
                    'date' => $projectSubmitedDate,
                    'status' => $projectSubmitedStatus,
                    'total_hours' => $totalHours,
                    'employeeName' => $employeeName,
                    'projectName' => $projectName,
                    'projectId' => $projectId,
                    'projectManagerStatus' => $projectManagerStatus,
                    'approvedBy' => $userLoginDetails,
                ];
            }
            return view('users.approvalTimeSheet', compact('TotalSubmitedData', 'assignedProjects'));
        } else {
            return view('users.approvalTimeSheet')->with('error', 'You are not authorized to access this page.');
        }
    }

    // public function updateStatusApprovalTimesheet(Request $request)
    // {
    //     $request->validate([
    //         'status' => 'required|in:1,2',
    //         'timeSheet_Id' => 'required|exists:time_entries,id',
    //         'reason' => 'required_if:status,2',
    //         'approvedBy' => 'required_if:status,1',
    //     ]);

    //     $newStatus = $request->input('status');
    //     $timeSheetId = $request->input('timeSheet_Id');
    //     $approvedByEmployeeId = $request->input('approvedBy');

    //     $timeEntry = TimeEntry::findOrFail($timeSheetId);

    //     $timeEntry->status = $newStatus;
    //     $timeEntry->approvedby_employee_id = $approvedByEmployeeId;

    //     if ($newStatus == 2) {
    //         $rejectionReason = $request->input('reason');
    //         $timeEntry->rejectionReason = $rejectionReason;
    //     }
    //     // dd($timeEntry);

    //     $timeEntry->save();

    //     return redirect()->back()->with('success', 'Time entry status updated successfully.');
    // }

    public function updateStatusApprovalTimesheet(Request $request)
    {
        $request->validate([
            'status' => 'required|in:1,2',
            'timeSheet_Id' => 'required|exists:time_entries,id',
            'reason' => 'required_if:status,2',
            'approvedBy' => 'required_if:status,1',
        ]);

        $newStatus = $request->input('status');
        $timeSheetId = $request->input('timeSheet_Id');
        $approvedByEmployeeId = $request->input('approvedBy');

        $timeEntry = TimeEntry::findOrFail($timeSheetId);

        $timeEntry->status = $newStatus;
        $timeEntry->approvedby_employee_id = $approvedByEmployeeId;

        if ($newStatus == 2) {
            $rejectionReason = $request->input('reason');
            $timeEntry->rejectionReason = $rejectionReason;
        }

        $timeEntry->save();
        $userEmployeeId = $timeEntry->employee_id;
        $user = User::where('employee_Id', $userEmployeeId)->first();
        $projectManager = User::find($approvedByEmployeeId);
        $weekDates = $timeEntry->date;
        $totalHours = $timeEntry->total_hours;

        if ($newStatus == 1 && $user) {
            Mail::to($user->email)->send(new TimeSheetApproved($timeEntry, $user, $weekDates, $totalHours));
        } elseif ($newStatus == 2 && $user) {
            Mail::to($user->email)->send(new TimeSheetRejected($timeEntry, $user, $weekDates, $totalHours, $request->input('reason')));
        }
        return redirect()->back()->with('success', 'Time entry status updated successfully.');
    }


    public function get_project_data_by_projectmanager(Request $request)
    {

        $projectId = $request->input('projectId');

        $userLoginDetails = Auth::user()->employee_Id;

        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
            ->where('project_id', $projectId)
            ->paginate(10);

        $projectManagerAssignedProjectIds = $assignedProjects->pluck('project_id')->toArray();

        $timeEntries = TimeEntry::whereIn('project_id', $projectManagerAssignedProjectIds)
            ->with('employee', 'project')
            ->get();

        return response()->json($timeEntries);
    }
}
