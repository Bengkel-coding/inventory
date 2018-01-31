<?php namespace App\Http\Controllers\Backend;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Table;
use Image;
use trinata;

class LaporanController extends TrinataController
{
  
    public function __construct()
    {
        parent::__construct();

        $this->resource = "backend.laporan.";
    }

    public function getIndex()
    {
        
        return view($this->resource.'index');
    }

}
