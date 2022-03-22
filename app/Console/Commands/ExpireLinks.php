<?php

namespace App\Console\Commands;

use App\Models\Link;
use App\Mail\LinkExpiredMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ExpireLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command checks for expired links and deletes them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $links = Link::all();

        $this->info('Checking Links...');

            $links->each(function ($link) {

                if (now()->diffInMinutes($link->created_at) >= env('URL_EXPIRY_TIME', 5)) {

                    if ($link->user) {
                        Mail::to($link->user->email)->send(new LinkExpiredMail($link->user->name, $link->shortcode));
                    }

                    $link->delete();
                }

            });

            $this->info('Expired Links Cleared and Users Notifed!');
    }
}
