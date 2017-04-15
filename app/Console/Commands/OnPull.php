<?php

namespace TTEmpire\Console\Commands;

use Illuminate\Console\Command;

class OnPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'on-pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Does some maintenance on Git pull';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate');

        $cwd = getcwd();
        chdir(base_path());

        // composer install
        $root = base_path();
        `composer -d $root -n install`;

        // npm install
        `npm install`;

        // npm run script
        $script = env('APP_ENV', 'production');

        if ($script !== 'production') {
            $script = 'dev';
        }

        `npm run $script`;

        chdir($cwd);
    }
}
