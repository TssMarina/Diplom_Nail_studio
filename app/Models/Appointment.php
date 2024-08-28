<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'appointment';
    protected $fillable = [
        'datetime',
        'favour_id',
        'name',
        'phone',
        'master_id',
        'status'
    ];
}
