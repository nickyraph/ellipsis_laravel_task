<?php

namespace App\Console;

use App\Mail\LinkExpiredMail;
use App\Models\Link;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $links = Link::all();

            $links->each(function ($link) {

                if (now()->diffInMinutes($link->created_at) >= env('URL_EXPIRY_TIME', 5)) {

                    if ($link->user) {
                        Mail::to($link->user->email)->send(new LinkExpiredMail($link->user->name, $link->shortcode));
                    }

                    $link->delete();
                }
                
            });
        })->everyMinute();
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
