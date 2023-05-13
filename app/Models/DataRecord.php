<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRecord extends Model
{
    use HasFactory;
    protected $table = 'data_records1';

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'email',
    ];
}
