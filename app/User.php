<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use App\User;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $guarded = ['verify_password'];

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function rules($id="")
    {

        if(!empty($id))
        {
            $email = ',email,'.$id;
            $username = ',username,'.$id;
        }else{
            $email = '';
            $username = '';
            $rule['password'] = 'required';
            $rule['verify_password'] = 'required|same:password';
        }

        $rule = [
            'name'      => 'required|max:200',
            'email'     => 'required|email|unique:users'.$email,
            'role_id'   => 'required',
            'username'  => 'required|unique:users'.$username,
        ];
        
        return $rule;
        
    }

    public function head()
    {
        return $this->belongsTo(User::class,'head_id');
    }
}
