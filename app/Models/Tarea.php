<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{
    use SoftDeletes;
    // use HasFactory;
    public $timestamps = false;
}
