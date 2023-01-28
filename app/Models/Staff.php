<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Staff extends Authenticatable
{
    use HasFactory;

    protected $guard = "staff";

    protected $fillable = [
        'name',
        'jenis_kelamin',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
