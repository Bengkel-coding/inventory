<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TrinataConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trinata:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trinata Console for Development';

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
        $this->line('Tunggu');
        
        $this->output->progressStart(10);

        for ($i = 1; $i <= 3; $i++) {
            sleep(1);
            $this->output->progressAdvance();
            
            if($i==3)
            {
                \Artisan::call('migrate');
                \Artisan::call('db:seed');
                
                $path = public_path('contents/thumbnails');
                if (!\File::isDirectory($path))
                {
                    $result = \File::makeDirectory(public_path('contents/thumbnails'), 0777);
                }
            }
        }

        $this->output->progressFinish();
        $this->line('Update Telah Berhasil :)');
        // $this->line('By : Muhamad Reza');
    }
}
