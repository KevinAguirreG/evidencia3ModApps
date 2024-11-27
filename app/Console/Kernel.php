<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        'App\Console\Commands\ScopeMakeCommand',
        'App\Console\Commands\TraitMakeCommand',
        'App\Console\Commands\CrudMakerAllCommand',
        'App\Console\Commands\CrudMakerModelCommand',
        'App\Console\Commands\CrudMakerRequestCommand',
        'App\Console\Commands\CrudMakerDatatableCommand',
        'App\Console\Commands\CrudMakerControllerCommand',
        'App\Console\Commands\CrudMakerViewCommand',
        'App\Console\Commands\CrudMakerTranslationCommand',
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new \App\Jobs\CriticalInventories)->dailyAt('09:00');
        $schedule->job(new \App\Jobs\MonthlyReports)->lastDayOfMonth('09:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}