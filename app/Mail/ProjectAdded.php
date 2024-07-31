<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\AddProjects;
use App\Models\User;
use App\Models\employees;

class ProjectAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $projectManager;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AddProjects $project, employees $projectManager = null, User $admin = null)
    {
        $this->project = $project;
        $this->projectManager = $projectManager;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Project Assigned to You')
                    ->view('emails.project_added')
                    ->with([
                        'projectName' => $this->project->projectname,
                        'clientName' => $this->project->cilentname,
                        'startDate' => $this->project->projectstartdate,
                        'endDate' => $this->project->projectenddate,
                        'projectObjectives' => 'Brief description of the project objectives', // Modify as needed
                        'projectManagerName' => $this->projectManager ? $this->projectManager->name : 'N/A',
                        'kickOffMeetingDate' => 'Date and Time', // Modify as needed
                        'initialProjectPlanSubmission' => 'Deadline', // Modify as needed
                        'clientIntroductionMeeting' => 'Date and Time', // Modify as needed
                    ]);
    }
}
