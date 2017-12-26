<?php namespace App\Repositories;

use Excel;
use App\Models\Material;

class UploadArea
{
	public function __construct(Material $material)
	{
		$this->material = $material;	
		
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
    		$code = ['TUBULAR GOOD'=>'tubular','INSTRUMENT'=>'instrument','COCK & VALVE' =>'cock','FITTING & FLANGE'=>'fitting','BAHAN KIMIA & PERALATAN'=>'bahankimia', 'LAIN-LAIN'=>'lainlain'];

    		foreach ($results as $key => $value) {
    			
    			if (!$value->nama_material) {
    				$parent = $value->no;
    				$index = 0;
    				continue;	
    			} 

    			if (!in_array($parent, array_keys($code))) continue;
    			if (!in_array(strtolower(trim($value->satuan)), array_keys($satuan))) continue;

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

	public function parseMroAbt($path, $request)
	{
		$countData = 0;

		Excel::selectSheets('Sheet1')->load($path, function($reader) use($request) {
    		
    		$results = $reader->get();
    		
    		$mro = [];
    		$index = 1;
    		
    		$parent = null;
    		$satuan = ['mtr'=>'meter','pcs'=>'pieces','bh'=>'buah', 'roll'=>'roll','liter'=>'liter','unit'=>'unit'];
    		$code = ['TUBULAR GOOD'=>'tubular','INSTRUMENT'=>'instrument','COCK & VALVE' =>'cock','FITTING & FLANGE'=>'fitting','BAHAN KIMIA & PERALATAN'=>'bahankimia', 'LAIN-LAIN'=>'lainlain'];

    		foreach ($results as $key => $value) {
    			
    			if (!$value->nama_material) {
    				$parent = $value->no;
    				$index = 0;
    				continue;	
    			} 

    			if (!in_array($parent, array_keys($code))) continue;
    			if (!in_array(strtolower(trim($value->satuan)), array_keys($satuan))) continue;

    			$mro[$parent][$index]['name'] = $value->nama_material;
    			$mro[$parent][$index]['komag'] = $value->komag;
    			$mro[$parent][$index]['code'] = $value->kode_mro_abt;
    			$mro[$parent][$index]['unit'] = $satuan[strtolower(trim($value->satuan))];
    			$mro[$parent][$index]['year_acquisition'] = $value->tahun_perolehan;
    			$mro[$parent][$index]['amount'] = $value->saldo_awal_jumlah_material;
    			$mro[$parent][$index]['unit_price'] = $value->saldo_awal_harga_satuan;
    			$mro[$parent][$index]['type'] = 'mroabt';
    			$mro[$parent][$index]['category'] = $code[strtoupper($parent)];
    			$mro[$parent][$index]['description'] = $value->deskripsi_material;
    			$mro[$parent][$index]['warehouse_id'] = $request->warehouse;

    			$index++;
    		}
    		
    		if (is_array($mro)) {
    			$saveDataMro = $this->saveDataMroAbt($mro);
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

				if (! $this->isDataExist($value['category'], $value['komag'], $value['warehouse_id'])) continue;
				
				$model->save();
			}
			
		}

		if (env('CONSOLE_DUPLICATE', false)) \Artisan::call('trinata:duplicate-data');
	}

	public function saveDataMroAbt($data)
	{
		$fields = ['name','komag','code','description','unit','year_acquisition','amount','unit_price','type','category','warehouse_id'];
		
		foreach ($data as $parent) {
			
			foreach ($parent as $key => $value) {
				
				$model = new \App\Models\Material;
				foreach ($fields as $field) {
					
					$model->{$field} = $value[$field];
				}

				if (! $this->isDataExist($value['category'], $value['komag'], $value['warehouse_id'])) continue;
				
				$model->save();
			}
			
		}

		if (env('CONSOLE_DUPLICATE', false)) \Artisan::call('trinata:duplicate-data');
	}

	public function isDataExist($category=false, $komag=false, $warehouse=false, $current_komag=false)
	{
		if (!$category && !$komag && !$warehouse) return false;

		if ($current_komag) {
			$model = $this->material->whereKomag($komag)->whereCategory($category)->whereWarehouseId($warehouse)->whereNotIn('id', [$current_komag])->count();
			if ($model > 0) return false;
		} else {
			$model = $this->material->whereKomag($komag)->whereCategory($category)->whereWarehouseId($warehouse)->count();
			if ($model > 0) return false;	
		}
		
		return true;
	}
}