<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use Carbon\Carbon;
use App\Models\Material;
use App\Models\Mutation;
use App\Models\Utilization;
use App\Models\Reversion;
use App\Models\Assessment;
use Table;

class DashboardController extends TrinataController
{
	public function __construct(Material $model, Mutation $mutation, Utilization $utilization, Reversion $reversion, Assessment $assessment)
	{
		parent::__construct();
		$this->model = $model;
		$this->mutation = $mutation;
		$this->utilization = $utilization;
		$this->reversion = $reversion;
		$this->assessment = $assessment;

		$this->resource = "backend.dashboard-list.";
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

	public function getIndex(Request $request)
	{	

		// if(\Auth::User()->role_id == 1){
		$model = ['mutation', 'utilization', 'reversion', 'assessment'];
	   		$mutation = ['pending' => [2], 'approved' => [3], 'process' => [1,2,3,4]];
	   		$utilization = ['pending' => [2], 'approved' => [3], 'process' => [1,2,3,4]];
	   		$reversion = ['pending' => [2], 'approved' => [3], 'process' => [1,2,3,4]];
	   		$assessment = ['pending' => [2], 'approved' => [3], 'process' => [1,2,3]];

	   		foreach ($model as $val) {
	   			foreach ($$val as $key => $value) {
	   			$data_total[$val.'_'.$key] = $this->{$val}
	   								->select(\DB::raw('count(*) as status_mutation, status'))
	   								->whereIn('status', $value)
	   								// ->groupBy('status')
	   								->count();
	   			}
	   		}
	   	// dd($data_total);
	   		
		$charts = $this->chart();
		$last = UserActivity::orderBy('created_at','desc')->limit(5)->get();
		// dd($charts);
	   	return view('backend.dashboard-grafik' ,compact('charts','last','data_total'));
	}

	public function getMutation(Request $request)
	{
		$mutation = $this->mutation;
		return view($this->resource.'mutasi.index' ,compact('mutation', 'request'));
	}

	public function getDataMutation(Request $request)
	{
		if($request->type == 'pending'){
			$status = [2];
        }elseif($request->type == 'approved'){
        	$status = [3];
        }elseif($request->type == 'process'){
        	$status = [1,2,3,4];
        }

        $model = $this->model
                        ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'mutations.warehouse_id', 'mutations.proposed_warehouse_id', 'mutations.status')
                        ->join('mutations', 'materials.id', '=', 'mutations.material_id')
                        ->whereIn('mutations.status', $status)
                        ->get()
                        ;

        foreach ($model as $key => $value) {
            $value->setStatusLabelMutation($value->status);
        }

        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                return $model->warehouse()->first()->name;
            })
            ->addColumn('proposed_warehouse_id',function($model){
                $proposed_warehouse = injectModel('warehouse')->whereId($model->proposed_warehouse_id)->first();
                return $proposed_warehouse->name;
            })
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackend('pengajuan-mutasi/detail/'.$model->id)."' class='btn btn-info'>View Detail</a>";
                return $button;
            })
            ->make(true);

        return $data;
	}

	public function getUtilization(Request $request)
	{
		$utilization = $this->utilization;
		return view($this->resource.'pemanfaatan.index' ,compact('utilization', 'request'));
	}

	public function getDataUtilization(Request $request)
	{
		if($request->type == 'pending'){
			$status = [2];
        }elseif($request->type == 'approved'){
        	$status = [3];
        }elseif($request->type == 'process'){
        	$status = [1,2,3,4];
        }

        $model = $this->utilization
                        ->select('utilizations.no_utilization', 'utilizations.date_utilization', 'utilizations.to', 'utilizations.from', 'utilizations.status')
                        ->join('utilization_details', 'utilizations.id', '=', 'utilization_details.utilization_id')
                        ->join('materials', 'materials.id', '=', 'utilization_details.material_id')
                        ->whereIn('utilizations.status', $status)
                        ->get()
                        ;

        foreach ($model as $key => $value) {
            $value->setStatusLabelUtilization($value->status);
        }

        $data = Table::of($model)
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackend('pengajuan-pemanfaatan/detail/'.$model->id)."' class='btn btn-info'>View Detail</a>";
                return $button;
            })
            ->make(true);

        return $data;
	}

	public function getReversion(Request $request)
	{
		$reversion = $this->reversion;
		return view($this->resource.'pengembalian.index' ,compact('reversion', 'request'));
	}

	public function getDataReversion(Request $request)
	{
		if($request->type == 'pending'){
			$status = [2];
        }elseif($request->type == 'approved'){
        	$status = [3];
        }elseif($request->type == 'process'){
        	$status = [1,2,3,4];
        }

        $model = $this->reversion
                        ->select('reversions.no_return', 'reversions.date_return', 'reversions.received_by', 'reversions.no_request', 'reversions.status')
                        ->join('reversion_details', 'reversions.id', '=', 'reversion_details.reversion_id')
                        ->join('materials', 'materials.id', '=', 'reversion_details.material_id')
                        ->whereIn('reversions.status', $status)
                        ->get()
                        ;

        foreach ($model as $key => $value) {
            $value->setStatusLabelReversion($value->status);
        }

        $data = Table::of($model)
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackend('pengajuan-pengembalian/detail/'.$model->id)."' class='btn btn-info'>View Detail</a>";
                return $button;
            })
            ->make(true);

        return $data;
	}

	public function getAssessment(Request $request)
	{
		$assessment = $this->assessment;
		return view($this->resource.'inventarisasi.index' ,compact('assessment', 'request'));
	}

	public function getDataAssessment(Request $request)
	{
		if($request->type == 'pending'){
			$status = [2];
        }elseif($request->type == 'approved'){
        	$status = [3];
        }elseif($request->type == 'process'){
        	$status = [1,2,3];
        }

        $model = $this->model
                            ->select('materials.type', 'materials.id', 'materials.name', 'materials.komag', 'materials.description', 'assessments.warehouse_id', 'assessments.status')
                            ->join('assessments', 'assessments.material_id', '=', 'materials.id')
                            ->whereIn('assessments.status', $status)
                            ->get();

        foreach ($model as $key => $value) {
            $value->setStatusLabelAssessment($value->status);
        }       

        $data = Table::of($model)
            ->addColumn('warehouse_id',function($model){
                return $model->warehouse()->first()->name;
            })
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackend('pengajuan-inventarisasi/detail/'.$model->id)."' class='btn btn-info'>View Detail</a>";
                return $button;
            })
            ->make(true);

        return $data;
	}
}
