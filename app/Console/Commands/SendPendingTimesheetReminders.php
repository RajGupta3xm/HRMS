<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\addworkesEmployee;
use App\Models\TimeEntry;
use App\Models\employees;
use App\Models\AddProjects;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendPendingTimesheets extends Command
{
    protected $signature = 'email:send-pending-timesheets';
    protected $description = 'Send pending timesheets emails';

    public function __construct()
    {
        parent::__construct();
    }

    // public function handle()
    // {
    //     $UsersAlocation = addworkesEmployee::all();

    //     foreach ($UsersAlocation as $usersData) {
    //         $projectId = $usersData->project_id;
    //         $employeeId = $usersData->employee_Id;
    //         $startDate = $usersData->startdate;
    //         $endDate = $usersData->enddate;
            
    //         $carbonStartDate = Carbon::parse($startDate);
    //         $carbonEndDate = Carbon::parse($endDate);
    //         $mondaysCount = 0;
    //         $mondaysDates = [];

    //         while ($carbonStartDate <= $carbonEndDate) {
    //             if ($carbonStartDate->dayOfWeek == Carbon::MONDAY) {
    //                 $mondaysCount++;
    //                 $mondaysDates[] = $carbonStartDate->toDateString();
    //             }
    //             $carbonStartDate->addDay();
    //         }

    //         $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
    //             ->where('employee_id', $employeeId)
    //             ->where(function ($query) {
    //                 $query->where('status', 0)
    //                       ->orWhere('status', '!=', 1);
    //             })
    //             ->pluck('date')
    //             ->toArray();

    //         $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);

    //         if (!empty($pendingTimesheetDates)) {
    //             $employee = employees::where('id', $employeeId)->first();
    //             $employeeEmail = $employee ? $employee->officialemail : 'Employee Not Found';

    //             Mail::raw('Pending Timesheets: ' . implode(', ', $pendingTimesheetDates), function ($message) use ($employeeEmail) {
    //                 $message->to($employeeEmail)->subject('Pending Timesheets');
    //             });
    //         }
    //     }

    //     $this->info('Emails sent successfully!');
    // }
    public function handle()
    {
        $UsersAlocation = addworkesEmployee::all();

        foreach ($UsersAlocation as $usersData) {
            $projectId = $usersData->project_id;
            $employeeId = $usersData->employee_Id;
            $startDate = $usersData->startdate;
            $endDate = $usersData->enddate;
            
            $carbonStartDate = Carbon::parse($startDate);
            $carbonEndDate = Carbon::parse($endDate);
            $mondaysCount = 0;
            $mondaysDates = [];

            while ($carbonStartDate <= $carbonEndDate) {
                if ($carbonStartDate->dayOfWeek == Carbon::MONDAY) {
                    $mondaysCount++;
                    $mondaysDates[] = $carbonStartDate->toDateString();
                }
                $carbonStartDate->addDay();
            }

            $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                ->where('employee_id', $employeeId)
                ->where(function ($query) {
                    $query->where('status', 0)
                          ->orWhere('status', '!=', 1);
                })
                ->pluck('date')
                ->toArray();

            $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);

            if (!empty($pendingTimesheetDates)) {
                $employee = employees::where('id', $employeeId)->first();
                $employeeEmail = $employee ? $employee->officialemail : 'Employee Not Found';
                $employeeName = $employee ? $employee->name : 'Employee';

                $weekDates = implode(', ', $mondaysDates);

                Mail::send('emails.pending_timesheet_reminder', [
                    'user' => (object) ['name' => $employeeName],
                    'weekDates' => $weekDates,
                    'pendingTimesheetDates' => $pendingTimesheetDates,
                ], function ($message) use ($employeeEmail) {
                    $message->to($employeeEmail)->subject('Pending Timesheets Reminder');
                });
            }
        }

        $this->info('Emails sent successfully!');
    }
}
