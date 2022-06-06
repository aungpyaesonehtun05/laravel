<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Teacher extends Model
{
    use softDeletes;
    protected $primaryKey = 'teacher_id';
    protected $table = 'teacher';
    protected $guarded = [];
    public $timestamps = false;
}
