<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class TrinataConsole extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'trinata:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trinata Console for Development';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Tunggu');
        
        
        \Artisan::call('migrate');
        \Artisan::call('db:seed');
                
        $path = public_path('contents/thumbnails');
        if (!\File::isDirectory($path))
        {
            $result = \File::makeDirectory(public_path('contents/thumbnails'), 0777);
        }
        
        $this->line('Update Telah Berhasil :)');
        
    }

}
