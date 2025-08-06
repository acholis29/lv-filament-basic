<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsActivitiessub extends Model
{
    //

    protected $fillable = [
        'ms_activities_id',
        'sub_activity_name',
        'description',
        'is_active',
    ];
}
