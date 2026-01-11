<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emailbackup extends Model
{
    protected $table = "correobackup";
    protected $fillable = [
        'email'
    ];
}
