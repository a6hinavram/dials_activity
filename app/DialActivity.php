<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DialActivity extends Model
{
    protected $fillable = [
        'task_id', 'owner'
    ];
}
