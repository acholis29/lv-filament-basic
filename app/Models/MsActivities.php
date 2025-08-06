<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsActivities extends Model
{
    // protected $primaryKey = 'uid';
    // protected $keyType = 'string';
    // public $incrementing = false;

    // protected $table = 'ms_activities';
    protected $fillable = [
        'ms_suppliers_id',
        'msbranch_id',
        'ms_activitiescategorys_id',
        'activity_name',
        'description',
        'pickup_time',
        'drop_time',
        'is_active',
    ];
    protected $casts = [
        'uid' => 'string',
        'pickup_time' => 'datetime',
        'drop_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function Msbranch()
    {
        return $this->belongsTo(Msbranch::class);
    }
    public function MsActivitiescategorys()
    {
        return $this->belongsTo(MsActivitiescategorys::class);
    }
    public function MsSuppliers()
    {
        return $this->belongsTo(MsSuppliers::class);
    }

    public function MsActivitiessub(): HasMany
    {
        return $this->HasMany(MsActivitiessub::class, 'ms_activities_id', 'id');
    }
}
