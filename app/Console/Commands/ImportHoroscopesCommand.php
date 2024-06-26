<?php

namespace App\Console\Commands;

use App\Http\Controllers\HoroscopeController;
use Illuminate\Console\Command;

class ImportHoroscopesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-horoscopes-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $horoscopeController = new HoroscopeController();
        $horoscopeController->importHoroscopes();
    }
}
