<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    //
    protected $casts = [
        'published_at' => 'datetime', // Laravel sẽ tự convert string sang Carbon
    ];
    protected $guarded = [];
    
}
