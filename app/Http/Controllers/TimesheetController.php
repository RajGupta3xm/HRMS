<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use App\Models\AddworkesEmployee;
use App\Models\TimeEntry;
use App\Models\TimeEntriesTemp;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\addworkesEmployee;
use App\Models\employees;
use App\Models\AddProjects;






use Illuminate\Support\Facades\Session;

class TimesheetController extends Controller
{
    public function Timesheet()
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $assignedProjects = addworkesEmployee::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->get();

        if ($assignedProjects->isEmpty()) {
            return view('users.time_Sheet', compact('assignedProjects'));
        }

        $projectStartDates = $assignedProjects->pluck('startdate')->toArray();
        $projectEndDates = $assignedProjects->pluck('enddate')->toArray();

        $minDate = min($projectStartDates);
        $maxDate = max($projectEndDates);

        return view('users.time_Sheet', compact('minDate', 'maxDate', 'assignedProjects'));
    }





    public function enterDateInProject(Request $request)
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $selectedDate = $request->input('week_start_date');

        $existingEntry = TimeEntry::where('employee_id', $userLoginDetails)
            ->where('date', $selectedDate)
            ->where('status', 1)
            ->get();
        // dd($existingEntry);

        if ($existingEntry->isNotEmpty()) {
            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');
            return view('users.submite_Data_View', compact('projects', 'datesAndDays', 'weekDates', 'existingEntry'));
        } else {
            $timeEntries = TimeEntriesTemp::where('date', $selectedDate)
                ->where('employee_id', $userLoginDetails)
                ->get()->toArray();

            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
                ->with('project')
                ->get();

            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');
            $totalTime = [
                'monday_hours' => 0,
                'tuesday_hours' => 0,
                'wednesday_hours' => 0,
                'thursday_hours' => 0,
                'friday_hours' => 0,
                'saturday_hours' => 0,
                'sunday_hours' => 0
            ];

            for ($i = 0; $i < count($timeEntries); $i++) {
                $totalTime['monday_hours'] += $timeEntries[$i]['monday_hours'];
                $totalTime['tuesday_hours'] += $timeEntries[$i]['tuesday_hours'];
                $totalTime['wednesday_hours'] += $timeEntries[$i]['wednesday_hours'];
                $totalTime['thursday_hours'] += $timeEntries[$i]['thursday_hours'];
                $totalTime['friday_hours'] += $timeEntries[$i]['friday_hours'];
                $totalTime['saturday_hours'] += $timeEntries[$i]['saturday_hours'];
                $totalTime['sunday_hours'] += $timeEntries[$i]['sunday_hours'];
            }

            $totalTime = [
                'monday_hours' => number_format($totalTime['monday_hours'], 2),
                'tuesday_hours' => number_format($totalTime['tuesday_hours'], 2),
                'wednesday_hours' => number_format($totalTime['wednesday_hours'], 2),
                'thursday_hours' => number_format($totalTime['thursday_hours'], 2),
                'friday_hours' => number_format($totalTime['friday_hours'], 2),
                'saturday_hours' => number_format($totalTime['saturday_hours'], 2),
                'sunday_hours' => number_format($totalTime['sunday_hours'], 2)
            ];

            return view('users.enterTimetheProject', compact('projects', 'datesAndDays', 'weekDates', 'timeEntries', 'assignedProjects', 'totalTime'));
        }
    }


    private function getProjects()
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->get();

        $projectNames = [];
        $projectIds = [];

        foreach ($assignedProjects as $assignedProject) {
            $projectId = $assignedProject->project->id;
            $projectName = $assignedProject->project->projectname;
            $projectNames[] = $projectName;
            $projectIds[] = $projectId;
        }

        return array_combine($projectIds, $projectNames);
    }

    private function setupDatesAndDays($selectedDate)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $selectedDate);
        $datesAndDays = [];

        $datesAndDays[] = [
            'date' => $startDate->toDateString(),
            'day' => $startDate->format('l'),
        ];

        for ($i = 1; $i <= 6; $i++) {
            $nextDate = $startDate->copy()->addDay($i);

            $datesAndDays[] = [
                'date' => $nextDate->toDateString(),
                'day' => $nextDate->format('l'),
            ];
        }

        Session::put('week_dates', $datesAndDays);
        return $datesAndDays;
    }

    public function checkDataExists(Request $request)
    {
        $selectedDate = $request->input('selected_date');

        $exists = TimeEntry::where('date', $selectedDate)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function enterTimeInProjectUpdate(Request $request)
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $selectedDate = $request->input('selected_date');
        $startDate = Carbon::createFromFormat('Y-m-d', $selectedDate);
        $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->get();

        $existingEntry = TimeEntry::where('employee_id', $userLoginDetails)
            ->where('date', $selectedDate)
            ->where('status', 1)
            ->exists();

        if ($existingEntry) {
            return redirect()->back()->with('error', 'Data for this date has already been Submited.');
        } else {
            $datesAndDays = [];

            $datesAndDays[] = [
                'date' => $startDate->toDateString(),
                'day' => $startDate->format('l'),
            ];

            for ($i = 1; $i <= 6; $i++) {
                $nextDate = $startDate->copy()->addDay($i);

                $datesAndDays[] = [
                    'date' => $nextDate->toDateString(),
                    'day' => $nextDate->format('l'),
                ];
            }

            Session::put('week_dates', $datesAndDays);
            $weekDates = Session::get('week_dates');

            $timeEntries = TimeEntriesTemp::where('date', $selectedDate)
                ->where('employee_id', $userLoginDetails)
                ->get()->toArray();





            $alreadyFilledData = TimeEntriesTemp::where('date', $selectedDate)
                ->with('project')
                ->get();


            $startDate = Carbon::createFromFormat('Y-m-d', $selectedDate);

            $datesAndDays = [];

            $datesAndDays[] = [
                'date' => $startDate->toDateString(),
                'day' => $startDate->format('l'),
            ];

            for ($i = 1; $i <= 6; $i++) {
                $nextDate = $startDate->copy()->addDay($i);

                $datesAndDays[] = [
                    'date' => $nextDate->toDateString(),
                    'day' => $nextDate->format('l'),
                ];
            }

            Session::put('week_dates', $datesAndDays);

            $weekDates = Session::get('week_dates');
            $userLoginDetails = Auth::user()->employee_Id;
            $assignedProjects = AddworkesEmployee::where('employee_Id', $userLoginDetails)
                ->with('project')
                ->get();

            $projectNames = [];


            foreach ($assignedProjects as $assignedProject) {
                $projectId = $assignedProject->project->id;

                $projectName = $assignedProject->project->projectname;
                $projectNames[] = $projectName;
                $projectIds[] = $projectId;
            }
            $projects = array_combine($projectIds, $projectNames);
            $projects = $this->getProjects();
            $datesAndDays = $this->setupDatesAndDays($selectedDate);
            $weekDates = Session::get('week_dates');
            $totalTime = [
                'monday_hours' => 0,
                'tuesday_hours' => 0,
                'wednesday_hours' => 0,
                'thursday_hours' => 0,
                'friday_hours' => 0,
                'saturday_hours' => 0,
                'sunday_hours' => 0
            ];

            for ($i = 0; $i < count($timeEntries); $i++) {
                $totalTime['monday_hours'] += $timeEntries[$i]['monday_hours'];
                $totalTime['tuesday_hours'] += $timeEntries[$i]['tuesday_hours'];
                $totalTime['wednesday_hours'] += $timeEntries[$i]['wednesday_hours'];
                $totalTime['thursday_hours'] += $timeEntries[$i]['thursday_hours'];
                $totalTime['friday_hours'] += $timeEntries[$i]['friday_hours'];
                $totalTime['saturday_hours'] += $timeEntries[$i]['saturday_hours'];
                $totalTime['sunday_hours'] += $timeEntries[$i]['sunday_hours'];
            }

            $totalTime = [
                'monday_hours' => number_format($totalTime['monday_hours'], 2),
                'tuesday_hours' => number_format($totalTime['tuesday_hours'], 2),
                'wednesday_hours' => number_format($totalTime['wednesday_hours'], 2),
                'thursday_hours' => number_format($totalTime['thursday_hours'], 2),
                'friday_hours' => number_format($totalTime['friday_hours'], 2),
                'saturday_hours' => number_format($totalTime['saturday_hours'], 2),
                'sunday_hours' => number_format($totalTime['sunday_hours'], 2)
            ];
            return view('users.enterTimetheProject', compact('projects', 'datesAndDays', 'weekDates', 'timeEntries', 'totalTime', 'assignedProjects'));
        }
    }
    public function enterDateInProjectTempSave(Request $request)
    {

        $projectIds = $request->input('selected_project_id');
        $selectedDate = $request->input('selected_date');
        $selectIds = $request->input('selected_id');
        $employeeId = Auth::user()->employee_Id;

        foreach ($projectIds as $index => $projectId) {
            $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
            $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');
            $mondayHours = $request->input('monday')[$index] ?? '0';
            $tuesdayHours = $request->input('tuesday')[$index] ?? '0';
            $wednesdayHours = $request->input('wednesday')[$index] ?? '0';
            $thursdayHours = $request->input('thursday')[$index] ?? '0';
            $fridayHours = $request->input('friday')[$index] ?? '0';
            $saturdayHours = $request->input('saturday')[$index] ?? '0';

            $totalHours = $request->input('total_Hours')[$index] ?? '0';
            $descriptions = $request->input('description')[$index];

            $selectId = $selectIds[$index] ?? null;

            if ($selectId) {
                $existingEntry = TimeEntriesTemp::find($selectId);

                if ($existingEntry) {
                    $existingEntry->project_id = $projectId;
                    $existingEntry->employee_id = $employeeId;
                    $existingEntry->date = $date;
                    $existingEntry->day = $day;
                    $existingEntry->monday_hours = $mondayHours;
                    $existingEntry->tuesday_hours = $tuesdayHours;
                    $existingEntry->wednesday_hours = $wednesdayHours;
                    $existingEntry->thursday_hours = $thursdayHours;
                    $existingEntry->friday_hours = $fridayHours;
                    $existingEntry->saturday_hours = $saturdayHours;

                    $existingEntry->total_hours = $totalHours;
                    $existingEntry->descriptions = $descriptions;
                    $existingEntry->save();
                }
            } else {

                $newEntry = new TimeEntriesTemp();
                $newEntry->project_id = $projectId;
                $newEntry->employee_id = $employeeId;
                $newEntry->date = $date;
                $newEntry->day = $day;
                $newEntry->monday_hours = $mondayHours;
                $newEntry->tuesday_hours = $tuesdayHours;
                $newEntry->wednesday_hours = $wednesdayHours;
                $newEntry->thursday_hours = $thursdayHours;
                $newEntry->friday_hours = $fridayHours;
                $newEntry->saturday_hours = $saturdayHours;

                $newEntry->total_hours = $totalHours;
                $newEntry->descriptions = $descriptions;
                $newEntry->save();
            }
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Saved Successfully');
    }

    public function EnterTimeInProject(Request $request)
    {
        $projectIds = $request->input('selected_project_id');
        $selectedDate = $request->input('selected_date');

        foreach ($projectIds as $index => $projectId) {
            $date = Carbon::createFromFormat('Y-m-d', $selectedDate)->toDateString();
            $day = Carbon::createFromFormat('Y-m-d', $selectedDate)->format('l');

            $mondayHours = $request->input('monday')[$index];
            $tuesdayHours = $request->input('tuesday')[$index];
            $wednesdayHours = $request->input('wednesday')[$index];
            $thursdayHours = $request->input('thursday')[$index];
            $fridayHours = $request->input('friday')[$index];
            $totalHours = $request->input('total_Hours')[$index];
            $descriptions = $request->input('description')[$index];
            $saturdayHours = $request->input('saturday')[$index] ?? '0';
            // $sundayHours = $request->input('sunday')[$index];

            $timeEntry = new TimeEntry();
            $timeEntry->project_id = $projectId;
            $timeEntry->employee_id = Auth::user()->employee_Id;
            $timeEntry->date = $date;
            $timeEntry->day = $day;
            $timeEntry->monday_hours = $mondayHours;
            $timeEntry->tuesday_hours = $tuesdayHours;
            $timeEntry->wednesday_hours = $wednesdayHours;
            $timeEntry->thursday_hours = $thursdayHours;
            $timeEntry->friday_hours = $fridayHours;
            $timeEntry->saturday_hours = $fridayHours;

            $timeEntry->total_hours = $totalHours;
            $timeEntry->descriptions = $descriptions;

            $timeEntry->saturday_hours = $saturdayHours;
            // $timeEntry->sunday_hours = $sundayHours;
            $timeEntry->status = 0;

            $timeEntry->save();
        }

        return redirect()->route('user.timeSheet')->with('status', 'Timesheet Added Successfully');
    }

    public function showTimeEntriesByDateAndDay($date, $day)
    {
        $timeEntries = TimeEntry::where('date', $date)
            ->where('day', $day)
            ->get();


        return view('time_entries', compact('timeEntries'));
    }


    // public function submitedTimesheet()
    // {
    //     $userLoginDetails = Auth::user()->employee_Id;
    //     $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
    //         ->with('project')
    //         ->paginate(10);
    //     $timeEntries = TimeEntry::where('employee_Id', $userLoginDetails)
    //         ->with(['employee', 'addworkesEmployees' => function ($query) use ($userLoginDetails) {
    //             $query->where('employee_Id', $userLoginDetails);
    //         }])
    //         ->get()
    //         ->toArray();

    //     $employeeTotalHours = [];
    //     $approvedEmployeeName = null;
    //     $timeSheetStatus = [];

    //     foreach ($timeEntries as $timeEntry) {
    //         $approvedEmployeeIds[] = $timeEntry['approvedby_employee_id'];
    //         $timeSheetStatus[] = $timeEntry['status'];
    //         $employeeId = $timeEntry['employee']['id'];
    //         $employeeName = $timeEntry['employee']['name'];
    //         $employeeEmail = $timeEntry['employee']['officialemail'];
    //         $totalHours = $timeEntry['total_hours'];
    //         $relevantEmployeeAllocation = array_filter($timeEntry['addworkes_employees'], function ($allocation) use ($employeeId) {
    //             return $allocation['employee_Id'] == $employeeId;
    //         });
    //         $employeeAllcationStartDate = reset($relevantEmployeeAllocation)['startdate'];
    //         $employeeAllcationEndDate = reset($relevantEmployeeAllocation)['enddate'];
    //         $startDate = strtotime($employeeAllcationStartDate);
    //         $endDate = strtotime($employeeAllcationEndDate);
    //         $mondaysCount = 0;
    //         $mondaysDates = [];
    //         $submittedTimesheetDates = [];
    //         $pendingTimesheetDates = [];

    //         for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
    //             if (date('N', $currentDate) == 1) {
    //                 $mondaysCount++;
    //                 $mondaysDates[] = date('Y-m-d', $currentDate);
    //             }
    //         }

    //         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)->where('employee_id', $employeeId)->get();
    //         foreach ($submittedTimesheets as $timesheet) {
    //             $submittedTimesheetDates[] = $timesheet->date;
    //         }
    //         $submittedTimesheetsCount = count($submittedTimesheetDates);

    //         $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheetDates);
    //         $pendingTimesheetsCount = count($pendingTimesheetDates);



    //         if (isset($employeeTotalHours[$employeeId])) {
    //             $employeeTotalHours[$employeeId]['total_hours'] += $totalHours;
    //         } else {
    //             $employeeTotalHours[$employeeId] = [
    //                 'approvedEmployeeName' => $approvedEmployeeName,
    //                 'name' => $employeeName,
    //                 'total_hours' => $totalHours,
    //                 'startDate' => $employeeAllcationStartDate,
    //                 'endDate' => $employeeAllcationEndDate,
    //                 'mondaysCount' => $mondaysCount,
    //                 'mondaysDates' => $mondaysDates,
    //                 'submittedTimesheetsCount' => $submittedTimesheetsCount,
    //                 'submittedTimesheetDates' => $submittedTimesheetDates,
    //                 'pendingTimesheetsCount' => $pendingTimesheetsCount,
    //                 'pendingTimesheetDates' => $pendingTimesheetDates,
    //                 'employeeEmail' => $employeeEmail,
    //             ];
    //         }
    //         dd($employeeTotalHours);

    //     }



    //     return view('users.submited_timesheet', ['submitedProjects' => $submitedProjects, 'employeeTotalHours' => $employeeTotalHours]);
    // }
    public function submitedTimesheet()
    {
        $userLoginDetails = Auth::user()->employee_Id;
        $submitedProjects = TimeEntry::where('employee_Id', $userLoginDetails)
            ->with('project')
            ->paginate(10);
        $timeEntries = TimeEntry::where('employee_Id', $userLoginDetails)
            ->with(['employee', 'addworkesEmployees' => function ($query) use ($userLoginDetails) {
                $query->where('employee_Id', $userLoginDetails);
            }])
            ->get();

        $employeeTotalHours = [];

        foreach ($timeEntries as $timeEntry) {
            $employeeId = $timeEntry->employee->id;
            $employeeName = $timeEntry->employee->name;
            $employeeEmail = $timeEntry->employee->officialemail;
            $totalHours = $timeEntry->total_hours;
            $relevantEmployeeAllocation = $timeEntry->addworkesEmployees->first();
            $employeeAllocationStartDate = $relevantEmployeeAllocation->startdate;
            $employeeAllocationEndDate = $relevantEmployeeAllocation->enddate;
            $startDate = strtotime($employeeAllocationStartDate);
            $endDate = strtotime($employeeAllocationEndDate);

            $mondaysCount = 0;
            $mondaysDates = [];
            for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += 86400) {
                if (date('N', $currentDate) == 1) {
                    $mondaysCount++;
                    $mondaysDates[] = date('Y-m-d', $currentDate);
                }
            }
            $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                ->where('employee_Id', $employeeId)
                ->get()
                ->pluck('date')
                ->toArray();

            $submittedTimesheetsCount = count($submittedTimesheets);
            $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
            $pendingTimesheetDatesBeforeCurrent = [];
            $currentDate = strtotime(date('Y-m-d'));

            foreach ($pendingTimesheetDates as $date) {
                if (strtotime($date) < $currentDate) {
                    $pendingTimesheetDatesBeforeCurrent[] = $date;
                }
            }

            $pendingTimesheetsCount = count($pendingTimesheetDatesBeforeCurrent);
            $employeeTotalHours[$employeeId] = [
                'name' => $employeeName,
                'total_hours' => $totalHours,
                'startDate' => $employeeAllocationStartDate,
                'endDate' => $employeeAllocationEndDate,
                'mondaysCount' => $mondaysCount,
                'mondaysDates' => $mondaysDates,
                'submittedTimesheetsCount' => $submittedTimesheetsCount,
                'submittedTimesheetDates' => $submittedTimesheets,
                'pendingTimesheetsCount' => $pendingTimesheetsCount,
                'pendingTimesheetDates' => $pendingTimesheetDatesBeforeCurrent,
                'employeeEmail' => $employeeEmail,
            ];
        }
        // dd($employeeTotalHours);
        // $UsersAlocation = addworkesEmployee::all();

        // foreach ($UsersAlocation as $usersData) {
        //     $projectId = $usersData->project_id;
        //     $employeeId = $usersData->employee_Id;
        //     $startDate = $usersData->startdate;
        //     $endDate = $usersData->enddate;
    
        //     // Convert start date and end date to Carbon objects for easier date manipulation
        //     $carbonStartDate = Carbon::parse($startDate);
        //     $carbonEndDate = Carbon::parse($endDate);
    
        //     // Initialize arrays to store Mondays count and dates
        //     $mondaysCount = 0;
        //     $mondaysDates = [];
    
        //     // Loop through each day from start date to end date
        //     while ($carbonStartDate <= $carbonEndDate) {
        //         // Check if the current day is a Monday (Carbon Monday is 1)
        //         if ($carbonStartDate->dayOfWeek == Carbon::MONDAY) {
        //             $mondaysCount++;
        //             $mondaysDates[] = $carbonStartDate->toDateString(); // Store the date as a string
        //         }
        //         // Move to the next day
        //         $carbonStartDate->addDay();
        //     }
    
        //     Output results for each employee-project allocation
        //     echo "Employee ID: $employeeId, Project ID: $projectId <br>";
        //     echo "Number of Mondays: $mondaysCount <br>";
        //     echo "Mondays Dates: " . implode(', ', $mondaysDates) . "<br><br>";
        // }
      
         // dd($employeeTotalHours);
            return view('users.submited_timesheet', ['submitedProjects' => $submitedProjects, 'employeeTotalHours' => $employeeTotalHours]);
        }
    

    public function getProjectData(Request $request)
    {
        $employeeId = Auth::user()->employee_Id;
        $projectId = $request->input('projectId');

        $submitedProjects = TimeEntry::where('employee_id', $employeeId);

        if ($projectId != '') {
            $submitedProjects = $submitedProjects->where('project_id', $projectId);
        }

        $submitedProjects = $submitedProjects->with('project', 'approvedByEmployee')->get();
        // dd($submitedProjects);
        return response()->json($submitedProjects);
    }
}
