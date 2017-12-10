<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        

        if(\DB::table('menus')->count() == 0)
        {
            $this->call('StarterSeed');
            \DB::unprepared(file_get_contents(database_path('backup/core.sql')));
        }   
        
        $this->call('MenuSeed'); 
        // sleep(1);
        // $this->call('UserSeed');   
    }   
}
