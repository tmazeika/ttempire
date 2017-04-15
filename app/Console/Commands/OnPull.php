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
        $env = config('app.env');

        $cwd = getcwd();
        chdir(base_path());

        // migrate
        exec('php artisan --env=dev migrate');

        // composer install
        $root = base_path();
        exec("composer -d $root -n install");

        // npm install
        $npmDir = base_path('.npm');
        exec("NPM_PACKAGES=\"$npmDir\"; npm install");

        // npm run script
        $script = $env;

        if ($env !== 'production') {
            $script = 'dev';
        }

        exec("NPM_PACKAGES=\"$npmDir\"; npm run $script");

        chdir($cwd);
    }
}
