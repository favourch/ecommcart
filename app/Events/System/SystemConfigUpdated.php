<?php

namespace App\Events\System;

use App\SystemConfig;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class SystemConfigUpdated
{
    use Dispatchable, SerializesModels;

    public $system;

    /**
     * Create a new job instance.
     *
     * @param  System  $system
     * @return void
     */
    public function __construct(SystemConfig $system)
    {
        $this->system = $system;
    }
}
