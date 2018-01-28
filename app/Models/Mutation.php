<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\Warehouse;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mutation extends Model
{
    use SoftDeletes;
    protected $table = 'mutations';

    public $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function proposed_warehouse()
    {
        return $this->belongsTo(Warehouse::class,'proposed_warehouse_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function setStatusLabel($value)
    {
        $statusLabel = [0 => 'Pengajuan Ditolak',
                        1 => 'Menunggu persetujuan kepala gudang',
                        2 => 'Menunggu konfirmasi admin BUI',
                        3 => 'Menunggu verifikasi admin gudang tujuan',
                        4 => 'menunggu persetujuan verifikasi kepala gudang',
                        5 => 'Pengajuan disetujui'
                        ];

        $this->attributes['status'] = $statusLabel[$value];
        
    }
}