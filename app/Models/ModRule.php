<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModRule extends Model
{
    protected $fillable = [
        'toggle_id', 'toggle_option_id', 'target_id', 'action'
    ];

}
