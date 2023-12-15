<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;


class Member extends User {
    use HasFactory,HasRoles;

    protected $table = 'users'; 

    protected $fillable = ['name', 'email', 'role', 'password']; 

}
