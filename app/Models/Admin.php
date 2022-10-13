<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table='admins';
    protected $guard='admin';
    protected $primaryKey='admin_id';
    protected $fillable = [
        'ad_name',
        'ad_email',
        'ad_password',
        'role'
    ];
    protected $hidden = [
        'ad_password', 'remember_token',
    ];
    public function getAuthPassword() // mac dinh laravel check la password nen phai ghi de thanh ad_pw
    {
        return $this->ad_password;
    }
    use HasFactory;
}
