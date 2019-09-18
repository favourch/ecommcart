<?php

namespace App\Jobs;

use App\System;
use App\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\System\NewContactUsMessage;

class SendContactFromMessageToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ContactUs $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $system = System::orderBy('id', 'asc')->first();
        $system->notify(new NewContactUsMessage($this->message));
    }
}
