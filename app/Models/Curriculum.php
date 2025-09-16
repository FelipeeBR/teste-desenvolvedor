<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculum';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'position',
        'education',
        'observations',
        'file_name',
        'file_path',
        'created_at',
        'updated_at',
        'ip_address'
    ];
}
