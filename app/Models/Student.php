<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable 
{
    use HasFactory;

    protected $table = 'student'; 
    protected $fillable = [
        'studentname', 'mssv', 'email', 'password', 
        'status', 'role', 'profile_image'
    ];

    protected $hidden = ['password'];

    public $timestamps = false;

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    
}
