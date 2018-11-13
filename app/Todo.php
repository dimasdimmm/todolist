<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'todoName',
        'created_at',
        'updated_at'
    ];
}
