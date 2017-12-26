<?php namespace App\Repositories;

use Excel;
use App\Models\Material;

class UploadArea
{
	public function __construct(Material $material)
	{
		$this->material = $material;	
		
		$this->articleField = ['slug', 'title', 'intro','description','year','status','author_id'];
		$this->researchField = ['article_content_id', 'intro', 'summary','background','goal','conclusion','recommendation','recommendation_target','location','file'];
	}

	public function parseMro($path, $request)
	{
		$countData = 0;

		Excel::selectSheets('Sheet1')->load($path, function($reader) use($request) {
    		
    		$results = $reader->get();
    		
    		$mro = [];
    		$index = 1;
    		
    		$parent = null;
    		$satuan = ['mtr'=>'meter','pcs'=>'pieces','bh'=>'buah', 'roll'=>'roll','liter'=>'liter','unit'=>'unit'];
    		$code = ['TUBULAR GOOD'=>'tubular','INSTRUMENT'=>'instrument','COCK & VALVE' =>'cock','FITTING & FLANGE'=>'fitting','BAHAN KIMIA & PERALATAN'=>'kimia'];

    		foreach ($results as $key => $value) {
    			
    			if (!$value->nama_material) {
    				$parent = $value->no;
    				$index = 0;
    				continue;	
    			} 

    			if (!in_array($parent, array_keys($code))) continue;

    			$mro[$parent][$index]['name'] = $value->nama_material;
    			$mro[$parent][$index]['komag'] = $value->komag;
    			$mro[$parent][$index]['unit'] = $satuan[strtolower(trim($value->satuan))];
    			$mro[$parent][$index]['year_acquisition'] = $value->tahun_perolehan;
    			$mro[$parent][$index]['amount'] = $value->saldo_awal_jumlah_material;
    			$mro[$parent][$index]['unit_price'] = $value->saldo_awal_harga_satuan;
    			$mro[$parent][$index]['type'] = 'mro';
    			$mro[$parent][$index]['category'] = $code[strtoupper($parent)];
    			$mro[$parent][$index]['description'] = $value->deskripsi_material;
    			$mro[$parent][$index]['warehouse_id'] = $request->warehouse;

    			$index++;
    		}
    		
    		if (is_array($mro)) {
    			$saveDataMro = $this->saveDataMro($mro);
    		}
    		
		})->get();

		return true;
	}

	public function saveDataMro($data)
	{
		$fields = ['name','komag','description','unit','year_acquisition','amount','unit_price','type','category','warehouse_id'];
		
		foreach ($data as $parent) {
			
			foreach ($parent as $key => $value) {
				
				$model = new \App\Models\Material;
				foreach ($fields as $field) {
					
					$model->{$field} = $value[$field];
				}

				if (! $this->isDataExist($value['category'], $value['komag'])) continue;
				
				$model->save();
			}
			
		}

		if (env('CONSOLE_DUPLICATE', false)) \Artisan::call('trinata:duplicate-data');
	}

	public function isDataExist($category=false, $komag=false)
	{
		if (!$category && !$komag) return false;

		$model = $this->material->whereKomag($komag)->whereCategory($category)->count();
		if ($model > 0) return false;
		return true;
	}
}