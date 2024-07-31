<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\TimeEntry;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $approvedCount = TimeEntry::where('status', 1)->count();
        $pendingCount = TimeEntry::where('status', 0)->count();
        $rejectedCount = TimeEntry::where('status', 2)->count();

        $modules = Session::get('user_modules_' . auth()->id());

        return view('dashboard', ['modules' => $modules, 'approvedCount' => $approvedCount, 'pendingCount' => $pendingCount, 'rejectedCount' => $rejectedCount]);
    }

    public function approvedData()
    {
        $modules = Session::get('user_modules_' . auth()->id());

        $approvedData = TimeEntry::where('status', 1)->get();
        $employeeIds = $approvedData->pluck('employee_id');

        $timeEntries = collect();
        if (!$employeeIds->isEmpty()) {
            $timeEntries = TimeEntry::whereIn('employee_id', $employeeIds)->where('status', 1)
                ->with(['employee', 'project'])
                ->get();
        }
        // dd($timeEntries);

        $data = [];
        foreach ($timeEntries as $timeEntry) {
            $data[] = [
                'employeeName' => $timeEntry['employee']['name'],
                'weeksDate' => $timeEntry['date'],
                'projectName' => $timeEntry['project']['projectname'],
                'projectPm' => $timeEntry['project']['pmallocation'],

            ];
        }

        return view('dashboardApprovedData', [
            'modules' => $modules,
            'approvedData' => $data,
        ]);
    }

    public function pendingData()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $pendingData = TimeEntry::where('status', 0)->get();
        $employeeIds = $pendingData->pluck('employee_id');
        $timeEntries = collect();
        if (!$employeeIds->isEmpty()) {
            $timeEntries = TimeEntry::whereIn('employee_id', $employeeIds)->where('status', 0)
                ->with(['employee', 'project'])
                ->get();
        }
        $data = [];
        foreach ($timeEntries as $timeEntry) {
            $data[] = [
                'employeeName' => $timeEntry['employee']['name'],
                'weeksDate' => $timeEntry['date'],
                'projectName' => $timeEntry['project']['projectname'],
            ];
        }
        return view('dashboardPendingData', [
            'modules' => $modules,
            'approvedData' => $data,
        ]);
    }
    public function rejectedData()
    {
        $modules = Session::get('user_modules_' . auth()->id());
        $rejectedData = TimeEntry::where('status', 2)->get();
        $employeeIds = $rejectedData->pluck('employee_id');
        $timeEntries = collect();
        if (!$employeeIds->isEmpty()) {
            $timeEntries = TimeEntry::whereIn('employee_id', $employeeIds)->where('status', 2)
                ->with(['employee', 'project'])
                ->get();
        }
        $data = [];
        foreach ($timeEntries as $timeEntry) {
            $data[] = [
                'employeeName' => $timeEntry['employee']['name'],
                'weeksDate' => $timeEntry['date'],
                'projectName' => $timeEntry['project']['projectname'],
            ];
        }
        return view('dashboardrejectedData', [
            'modules' => $modules,
            'approvedData' => $data,
        ]);
    }
    //     public function fetchData(Request $request)
    //     {
    //         // Validate input
    //         $request->validate([
    //             'start_date' => 'required|date',
    //             'end_date' => 'required|date|after_or_equal:start_date',
    //         ]);

    //         // Retrieve data based on start_date and end_date
    //         $start_date = $request->input('start_date');
    //         $end_date = $request->input('end_date');

    //         $data = TimeEntry::whereBetween('date', [$start_date, $end_date])->get();
    // dd($data);
    //         // You can return the data to a view or process it further
    //         return view('your.view.name', compact('data'));
    //     }
    public function fetchData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        // Retrieve input dates
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $entries = TimeEntry::whereBetween('date', [$start_date, $end_date])
            ->whereIn('status', [0, 1, 2]) // Adjust status filters as needed
            ->get();

        $approvedCount = $entries->where('status', 1)->count();
        $rejectedCount = $entries->where('status', 2)->count();
        $pendingCount = $entries->where('status', 0)->count();

        return response()->json([
            'approvedCount' => $approvedCount,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
        ]);
    }
}
