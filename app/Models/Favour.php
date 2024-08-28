<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favour extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'favour';
    protected $fillable = [
        'name',
        'price',
        'category'
    ];
}
