<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\AddProjects;
use App\Models\User;

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
    public function __construct(AddProjects $project, User $projectManager = null, User $admin = null)
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
                        'projectObjectives' => 'Brief description of the project objectives', // Update this based on your project data
                        'projectManagerName' => $this->projectManager ? $this->projectManager->name : 'N/A',
                        'kickOffMeetingDate' => 'Date and Time', // Add actual data if available
                        'initialProjectPlanSubmission' => 'Deadline', // Add actual data if available
                        'clientIntroductionMeeting' => 'Date and Time', // Add actual data if available
                    ]);
    }
}
