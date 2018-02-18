<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Utilization;

use App\Models\ReversionDetail;

use Illuminate\Database\Eloquent\SoftDeletes;

class Reversion extends Model
{
    use SoftDeletes;
    protected $table = 'reversions';

    public $guarded = [];

    public function reversionDetail()
    {
        return $this->hasMany(ReversionDetail::class, 'reversion_id');
    }

    public function setStatusLabelReversion($value)
    {
        $statusLabel = [0 => 'Pengajuan Ditolak',
                        1 => 'Menunggu persetujuan Manager Area',
                        2 => 'Menunggu konfirmasi admin BUI',
                        3 => 'Menunggu verifikasi admin gudang tujuan',
                        4 => 'Menunggu verifikasi kepala gudang tujuan',
                        5 => 'Pengajuan disetujui'
                        ];

        $this->attributes['status'] = $statusLabel[$value];
        
    }

}