<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopupLog extends Model
{

	public $guarded = [];

	public function user()
    {
    	return $this->belongsTo(new User);
    }

}
