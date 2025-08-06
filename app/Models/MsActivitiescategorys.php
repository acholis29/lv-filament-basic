<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsActivitiescategorys extends Model
{
    //
    protected $table = 'ms_activitiescategorys';
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'uid' => 'string',
    ];


    public function MsActivitiescategorys()
    {
        return $this->belongsTo(MsActivitiescategorys::class);
    }
}
