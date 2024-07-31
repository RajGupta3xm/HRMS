<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendingTimesheetReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $employeeName;
    public $employeeEmail;
    public $projectName;
    public $pendingTimesheetDates;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employeeName, $employeeEmail, $projectName, $pendingTimesheetDates)
    {
        $this->employeeName = $employeeName;
        $this->employeeEmail = $employeeEmail;
        $this->projectName = $projectName;
        $this->pendingTimesheetDates = $pendingTimesheetDates;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.pendingTimesheetReminder')
                    ->subject('Pending Timesheet Reminder');
    }
}
