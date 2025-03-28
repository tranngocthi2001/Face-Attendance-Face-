<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';
    protected $fillable = ['subjectname'];

    public $timestamps = false;
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
