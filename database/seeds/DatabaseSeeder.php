<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if(\DB::table('menus')->count() == 0)
        {
            $this->call(StarterSeed::class);
        }   
        
        $this->call(MenuSeed::class);   
    }   
}
