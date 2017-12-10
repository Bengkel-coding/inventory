<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use Carbon\Carbon;

class DashboardController extends TrinataController
{
	public function __construct()
	{
		parent::__construct();
	}


	public function range($type)
	{
		$dates = [];
	    
	    $data = [];

	    for($a=-4;$a<=0;$a++)
	    {
	    	$minus = Carbon::now()->addDays($a);

	    	$dates[] = $minus->toFormattedDateString();

	    	$count = UserActivity::whereRaw('DATE(created_at) = "'.$minus->toDateString().'"')->count();

	    	$data[] = $count;
	    }

	    if($type == 'dates')
	    {
	    	return $dates;
	    }elseif($type == 'data'){
	    	return $data;
	    }
	    	
	}

	public function chart()
	{

		

		// $charts = [

		//     'chart' => ['type' => 'column'],
		//     'title' => ['text' => 'User Activities'],
		//     'xAxis' => [
		//         'categories' => $this->range('dates'),
		//     ],
		//     'credits' => [
		//     	'enabled'	=> false,
		//     ],
		//     'yAxis' => [
		//         'title' => [
		//             'text' => 'Total'
		//         ]
		//     ],
		//     'series' => [
		//         [
		//             'name' => 'User Activities',
		//             'data' => $this->range('data'),
		//         ],
		//     ]
		// ];
		$charts = [

		    'data' => implode(',', $this->range('data')),
		    'dates' => implode('","', $this->range('dates')),
		];

		return $charts;
	}

	public function getIndex()
	{	
		$charts = $this->chart();
		$last = UserActivity::orderBy('created_at','desc')->limit(5)->get();
		// dd($charts);
	   	return view('backend.dashboard' ,compact('charts','last'));
	}
}
