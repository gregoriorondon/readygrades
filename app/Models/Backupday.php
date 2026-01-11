<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backupday extends Model
{
    protected $table = "backupday";
    protected $fillable = ["day"];
}
