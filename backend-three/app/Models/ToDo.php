<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'to_do',
        'status'

    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

}
