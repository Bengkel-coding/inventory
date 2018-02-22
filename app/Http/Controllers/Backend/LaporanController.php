<?php namespace App\Http\Controllers\Backend;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Material;
use Table;
use Image;
use trinata;
use Excel;

class LaporanController extends TrinataController
{
  
    public function __construct()
    {
        parent::__construct();

        $this->resource = "backend.laporan.";
        $this->header = ['No',
        				'Nama Material',
        				'KOMAG',
        				];
        $this->subHeader = [
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'Jumlah Material',
        				'Harga Satuan',
        				'Harga Total',
        				'Jumlah Material',
        				'Harga Total',
        				'Jumlah Material',
        				'Harga Total',
        				'Jumlah Material',
        				'Harga Total',
        				'Penerimaan',
        				'',
        				'Pengeluaran',
        				'',
        				'Jumlah Material',
        				'Harga Satuan',
        				'Harga Total',
        				'','','','','','',
        				];
        $this->subSubHeader = ['','','','','','','','','','','','','','','',
        					'Jumlah Material','Harga Total',
        					'Jumlah Material','Harga Total',
        					'','','','','','','','',''];
    }

    public function getIndex()
    {
        
        return view($this->resource.'index');
    }

    public function getDownload(Request $request)
    {
    	
    	$categoryList = ['mro'=>'sheetMro',
                        'mroabt'=>'sheetMroAbt', 
                        'investasi'=>'sheetInvestasi',
                        ];
    	
    	$this->prepareExcel($categoryList, $request);
    	
    }

    public function prepareExcel($categoryList, $request)
    {
    	$filename = 'export-material-'.date('Ymdhis');
        
        Excel::create($filename, function($excel) use($categoryList, $request) {
            
            foreach ($categoryList as $key => $value) {
                $data = $this->getMaterialData($key);
                if ($data) {
                    
                    $sheetname = ucfirst($key);
                    $excel->sheet($sheetname, function($sheet) use($data, $request, $value) {
                        
                        $this->{$value}($sheet);
                        $baris = 4;
                   
                        foreach($data as $keys => $dataBaris){
                            $sheet->row($baris++, $this->prepareData($dataBaris, $keys));
                        }

                    });
                }
            }

            

        })->export('xls');
    }

    public function getMaterialData($category)
    {
    	return Material::whereType($category)->orderBy('category','warehouse_id')->take(10)->get();
    }

    public function prepareData($value, $key)
    {
    	$needCode = ['mroabt','investasi'];

    	$datas = [];
		$datas[] = $key+1;
		$datas[] = $value->name;
		$datas[] = $value->komag;
		if(in_array($value->type, $needCode)) $datas[] = $value->kode;
		$datas[] = $value->description;
		$datas[] = ucfirst($value->unit);
		$datas[] = $value->year_acquisition;
		$datas[] = $value->amount;
		$datas[] = number_format($value->unit_price);
		$datas[] = number_format($value->amount * $value->unit_price);

		return $datas;
    }
    public function sheetMro($sheet)
    {
    	$header = ['Deskripsi Material (berdasarkan Master KOMAG)',
        				'Satuan','Tahun Perolehan','Saldo Awal','','','Penerimaan','','Pengeluaran',
        				'','Pengembalian / Return','','Mutasi Antar Gudang','','','','Saldo Akhir',
        				'','','Tingkat Persediaan Minimal','Tingkat Persediaan Maksimal','Excess Stock',
        				'Status','Keterangan','Lokasi',
        				];
        $subHeader = ['','','','','','','Jumlah Material','Harga Satuan','Harga Total',
        				'Jumlah Material','Harga Total','Jumlah Material','Harga Total','Jumlah Material',
        				'Harga Total','Penerimaan','','Pengeluaran','','Jumlah Material','Harga Satuan',
        				'Harga Total','','','','','','',
        				];
       	$subSubHeader = ['','','','','','','','','','','','','','','',
        					'Jumlah Material','Harga Total',
        					'Jumlah Material','Harga Total',
        					'','','','','','','','',''];

        $sheet->setBorder('A1:AB1', 'thin');
    	$sheet->setBorder('A2:AB2', 'thin');
    	$sheet->setBorder('A3:AB3', 'thin');

    	$sheet->row(1, array_merge($this->header, $header)); 
        $sheet->row(2, $this->subHeader); 
        $sheet->row(3, $this->subSubHeader); 

        // merge column
        $setMerge = ['G1:I1','J1:K1','L1:M1','N1:O1','P1:S1','P2:Q2','R2:S2','T1:V1','A1:A3','B1:B3',
        			'C1:C3','D1:D3','E1:E3','F1:F3','G2:G3','H2:H3','I2:I3','J2:J3','K2:K3',
        			'L2:L3','M2:M3','N2:N3','O2:O3','T2:T3','U2:U3','V2:V3','W1:W3','X1:X3','Y1:Y3',
        			'Z1:Z3','AA1:AA3','AB1:AB3'];
		$this->setMergeCell($sheet, $setMerge);

        $setWidth = ['A'=>5,'B'=>20,'C'=>20,'D'=>20,'E'=>10,'F'=>20];
		$this->setWidth($sheet, $setWidth);

		$setAlignment = ['A1:A3'=>'#7FCC4C', 'B1:B3'=>'#7FCC4C','C1:C3'=>'#7FCC4C','D1:D3'=>'#7FCC4C',
						'E1:E3'=>'#7FCC4C','F1:F3'=>'#7FCC4C','G1:G3'=>'#7FCC4C','H1:H3'=>'#7FCC4C',
						'I1:I3'=>'#7FCC4C','W1:W3'=>'#7FCC4C','X1:X3'=>'#7FCC4C','Y1:Y3'=>'#7FCC4C',
						'Z1:Z3'=>'#7FCC4C','AA1:AA3'=>'#7FCC4C','AB1:AB3'=>'#7FCC4C'];
		$this->setAlignment($sheet, $setAlignment);
    }

    public function sheetMroAbt($sheet)
    {
    	$header = ['Kode MRO-ABT','Deskripsi Material (berdasarkan Master KOMAG)',
        				'Satuan','Tahun Perolehan','Saldo Awal','','','Penerimaan','','Pengeluaran',
        				'','Pengembalian / Return','','Mutasi Antar Gudang','','','','Tingkat Persediaan Minimal','Tingkat Persediaan Maksimal','Excess Stock',
        				'Status','Keterangan','Lokasi',
        				];
        $subHeader = ['','','','','','','','Jumlah Material','Harga Satuan','Harga Total',
        				'Jumlah Material','Harga Total','Jumlah Material','Harga Total','Jumlah Material',
        				'Harga Total','Penerimaan','','Pengeluaran','','','','','','','',
        				];
       	$subSubHeader = ['','','','','','','','','','','','','','','','',
        					'Jumlah Material','Harga Total',
        					'Jumlah Material','Harga Total',
        					'','','','','','',''];

        $sheet->setBorder('A1:Z1', 'thin');
    	$sheet->setBorder('A2:Z2', 'thin');
    	$sheet->setBorder('A3:Z3', 'thin');

    	$sheet->row(1, array_merge($this->header, $header)); 
        $sheet->row(2, $this->subHeader); 
        $sheet->row(3, $this->subSubHeader); 

        // merge column
        $setMerge = ['H1:J1','K1:L1','M1:N1','O1:P1','Q1:T1','Q2:R2','S2:T2','A1:A3','B1:B3',
        			'C1:C3','D1:D3','E1:E3','F1:F3','G1:G3','H2:H3','I2:I3','J2:J3','K2:K3',
        			'L2:L3','M2:M3','N2:N3','O2:O3','P2:P3','U1:U3','V1:V3','W1:W3','X1:X3','Y1:Y3',
        			'Z1:Z3'];
		$this->setMergeCell($sheet, $setMerge);

        $setWidth = ['A'=>5,'B'=>20,'C'=>20,'D'=>20,'E'=>10,'F'=>20];
		$this->setWidth($sheet, $setWidth);

		$setAlignment = ['A1:A3'=>'#7FCC4C', 'B1:B3'=>'#7FCC4C','C1:C3'=>'#7FCC4C','D1:D3'=>'#7FCC4C',
						'E1:E3'=>'#7FCC4C','F1:F3'=>'#7FCC4C','G1:G3'=>'#7FCC4C','H1:H3'=>'#7FCC4C',
						'I1:I3'=>'#7FCC4C','W1:W3'=>'#7FCC4C','X1:X3'=>'#7FCC4C','Y1:Y3'=>'#7FCC4C',
						'Z1:Z3'=>'#7FCC4C','AA1:AA3'=>'#7FCC4C','AB1:AB3'=>'#7FCC4C'];
		// $this->setAlignment($sheet, $setAlignment);
    }

    public function sheetInvestasi($sheet)
    {
        $header = ['Kode MI','Deskripsi Material (berdasarkan Master KOMAG)',
                        'Satuan','Tahun Perolehan','Saldo Awal','','','Penerimaan','','Pengeluaran',
                        '','Pengembalian / Return','','Mutasi Antar Gudang','','','','Saldo Akhir',
                        '','','Status','Surplus Material','Keterangan','Lokasi'
                        ];
        $subHeader = ['','','','','','','','Jumlah Material','Harga Satuan','Harga Total',
                        'Jumlah Material','Harga Total','Jumlah Material','Harga Total','Jumlah Material',
                        'Harga Total','Penerimaan','','Pengeluaran','','Jumlah Material','Harga Satuan',
                        'Harga Total','','','',''
                        ];
        $subSubHeader = ['','','','','','','','','','','','','','','','','',
                            'Jumlah Material','Harga Total',
                            'Jumlah Material','Harga Total',
                            '','','','','','',''];

        $sheet->setBorder('A1:AA1', 'thin');
        $sheet->setBorder('A2:AA2', 'thin');
        $sheet->setBorder('A3:AA3', 'thin');

        // dd(array_merge($this->header, $header), $subHeader);
        $sheet->row(1, array_merge($this->header, $header)); 
        $sheet->row(2, $subHeader); 
        $sheet->row(3, $subSubHeader); 

        // merge column
        $setMerge = ['H1:J1','K1:L1','M1:N1','O1:P1','Q1:T1','U1:W1','Q2:R2','S2:T2','A1:A3','B1:B3',
                    'C1:C3','D1:D3','E1:E3','F1:F3','G1:G3','H2:H3','I2:I3','J2:J3','K2:K3',
                    'L2:L3','M2:M3','N2:N3','O2:O3','P2:P3','U2:U3','V2:V3','W2:W3','X1:X3','Y1:Y3',
                    'Z1:Z3','AA1:AA3'];
        $this->setMergeCell($sheet, $setMerge);

        $setWidth = ['A'=>5,'B'=>20,'C'=>20,'D'=>20,'E'=>10,'F'=>20];
        $this->setWidth($sheet, $setWidth);

        $setAlignment = ['A1:A3'=>'#7FCC4C', 'B1:B3'=>'#7FCC4C','C1:C3'=>'#7FCC4C','D1:D3'=>'#7FCC4C',
                        'E1:E3'=>'#7FCC4C','F1:F3'=>'#7FCC4C','G1:G3'=>'#7FCC4C','H1:H3'=>'#7FCC4C',
                        'I1:I3'=>'#7FCC4C','W1:W3'=>'#7FCC4C','X1:X3'=>'#7FCC4C','Y1:Y3'=>'#7FCC4C',
                        'Z1:Z3'=>'#7FCC4C','AA1:AA3'=>'#7FCC4C','AB1:AB3'=>'#7FCC4C'];
        // $this->setAlignment($sheet, $setAlignment);
    }

    public function sheetEksjar($sheet)
    {

    }

    public function setMergeCell($sheet, $data)
    {
    	foreach ($data as $key => $value) {
    		$sheet->mergeCells($value);
    	}
    } 

    public function setWidth($sheet, $data)
    {
    	foreach ($data as $key => $value) {
    		$sheet->setWidth($key, $value);
    	}
    }

    public function setAlignment($sheet, $data)
    {
    	foreach ($data as $key => $value) {
    		$sheet->cells($key, function($cells) use ($value) {
	    		$cells->setAlignment('center')->setValignment('center')->setBackground($value);

			});
    	}
    }

}
