<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class cek5menit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cek:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $a = shell_exec("systemctl status php8.1-fpm | grep running");
        if (empty($a)) {
            shell_exec("systemctl start php8.1-fpm");
        }
        return 0;
    }
}
