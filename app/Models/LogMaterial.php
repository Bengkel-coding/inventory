<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
use App\Models\MaterialDetails;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogMaterial extends Model
{
    use SoftDeletes;
    protected $table = 'log_materials';

    public $guarded = [];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function details()
    {
    	return $this->hasMany(MaterialDetail::class,'material_id', 'id');
    }

    public function mro()
    {
        return $this->hasOne(\App\Models\MaterialMro::class,'material_id', 'id');
    }

    public function mroabt()
    {
        return $this->hasOne(\App\Models\MaterialMroabt::class,'material_id', 'id');
    }

    public function investasi()
    {
        return $this->hasOne(\App\Models\MaterialInvestasi::class,'material_id', 'id');
    }

    public function jaringan()
    {
        return $this->hasOne(\App\Models\MaterialEksjar::class,'material_id', 'id');
    }

    public function categoryAttribute($value)
    {
        $category = ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'];

        $this->attributes['category'] = $category[$value];
    }

    public function unitAttribute($value)
    {
        $unit = ['buah' => 'Buah', 'liter' => 'Liter' , 'meter' => 'Meter' , 'pieces' => 'Pieces' , 'roll' => 'Roll' , 'unit' => 'Unit'];

        $this->attributes['unit'] = $unit[$value];
    }

    public function unitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = number_format($value);
    }

    public function setStatusLabelMutation($value)
    {
        $statusLabel = [0 => 'Pengajuan Ditolak',
                        1 => 'Menunggu persetujuan kepala gudang',
                        2 => 'Menunggu konfirmasi admin BUI',
                        3 => 'Menunggu verifikasi admin gudang tujuan',
                        4 => 'Menunggu verifikasi kepala gudang tujuan',
                        5 => 'Pengajuan disetujui'
                        ];

        $this->attributes['status'] = $statusLabel[$value];
        
    }

    public function setStatusLabelAssessment($value)
    {
        $statusLabel = [0 => 'Pengajuan Ditolak',
                        1 => 'Menunggu persetujuan kepala gudang',
                        2 => 'Menunggu konfirmasi admin BUI',
                        3 => 'Pengajuan disetujui'
                        ];

        $this->attributes['status'] = $statusLabel[$value];
        
    }

}