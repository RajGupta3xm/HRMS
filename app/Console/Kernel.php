<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected $commands = [
        \App\Console\Commands\SendPendingTimesheets::class,
    ];
    
    // protected function schedule(Schedule $schedule)
    // {
    //     // Schedule the command to run every Monday at 8:00 AM
    //     $schedule->command('email:send-pending-timesheets')->everymintue();
    // }\
//     protected function schedule(Schedule $schedule)
// {
//     // Schedule the command to run every Wednesday at 12:30 PM
//     // $schedule->command('email:send-pending-timesheets')->everyMinute()->timezone('UTC');
//     $schedule->command('email:send-pending-timesheets')
//          ->dailyAt('02:05')
//          ->timezone('EDT');

    
// }
// protected function schedule(Schedule $schedule)
// {
//     $schedule->command('email:send-pending-timesheets')->dailyAt(4,'14:40');
// }
protected function schedule(Schedule $schedule)
{
    // $schedule->command('email:send-pending-timesheets')->dailyAt('14:44');
    $schedule->command('email:send-pending-timesheets')->weekly()->fridays()->at('01:20');






}

    
    
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
