<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TimeEntry;
use App\Models\User;

class TimeSheetApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $timeEntry;
    public $user;
    public $weekDates;
    public $totalHours;

    public function __construct(TimeEntry $timeEntry, User $user, $weekDates, $totalHours)
    {
        $this->timeEntry = $timeEntry;
        $this->user = $user;
        $this->weekDates = $weekDates;
        $this->totalHours = $totalHours;
    }

    public function build()
    {
        return $this->view('emails.timesheet_approved')
                    ->subject('Timesheet Approved')
                    ->with([
                        'timeEntry' => $this->timeEntry,
                        'user' => $this->user,
                        'weekDates' => $this->weekDates,
                        'totalHours' => $this->totalHours,
                    ]);
    }
}
