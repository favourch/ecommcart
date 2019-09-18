<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDemoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'incevio:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed demo data into the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('db:seed', ['--force' => true, '--class' => 'demoSeeder']);

        // if ( app()->runningInConsole() && (env('SCOUT_DRIVER') == 'mysql') )
        if (env('SCOUT_DRIVER') == 'mysql')
            $this->call('scout:mysql-index');

        $this->info('Demo data seeded!');

        \Log::info('DEMO DATA IMPORTED!');
    }
}
