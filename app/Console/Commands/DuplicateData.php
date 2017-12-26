<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DuplicateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trinata:duplicate-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trinata Console for Duplicate Data Import';

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
        $model = \App\Models\Material::whereDoesntHave('details')->select('id','amount','type','description','unit')->where('amount','>',0)->get();

        $uniqMaterial = ['meter','roll','liter'];
        
        if ($model) {
            foreach ($model as $key => $value) {

                if (in_array($value->unit, $uniqMaterial)) $total = 1;
                else $total = $value->amount;

                $this->duplicate($value, $total);
            }
        }
    }

    public function duplicate($data, $loop=1)
    {   
        $index = 1;
        for ($i=1; $i <= (int) $loop; $i++) { 

            $detail = new \App\Models\MaterialDetail;
            $detail->material_id = $data->id;
            $detail->details = $data->description;
            $detail->save();

            $index++;
            if ($index == 100) {
                sleep(1);
                $index = 1;
            }
        }
    }
}
