<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TimeEntry;
use App\Models\User;

class TimeSheetRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $timeEntry;
    public $user;
    public $weekDates;
    public $totalHours;
    public $rejectionReason;

    public function __construct(TimeEntry $timeEntry, User $user, $weekDates, $totalHours, $rejectionReason)
    {
        $this->timeEntry = $timeEntry;
        $this->user = $user;
        $this->weekDates = $weekDates;
        $this->totalHours = $totalHours;
        $this->rejectionReason = $rejectionReason;
    }

    public function build()
    {
        return $this->view('emails.timesheet_rejected')
                    ->subject('Timesheet Rejected')
                    ->with([
                        'timeEntry' => $this->timeEntry,
                        'user' => $this->user,
                        'weekDates' => $this->weekDates,
                        'totalHours' => $this->totalHours,
                        'rejectionReason' => $this->rejectionReason,
                    ]);
    }
}
