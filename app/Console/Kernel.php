<?php

namespace App\Console;

use App\Console\Commands\RateUpdateFromAPICommand;
use App\Console\Commands\RateUpdateFromTableCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        RateUpdateFromAPICommand:: class,
        RateUpdateFromTableCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('rate:update-from-table free')->dailyAt('7:00');
        $schedule->command('rate:update-from-table starter')->everyThreeHours();
        $schedule->command('rate:update-from-API enterprise')->hourly();

//        $schedule->command('rate:update')->everyMinute();
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
