<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MsActivities extends Model
{
    use SoftDeletes;
    use Notifiable;



    protected $fillable = [
        'ms_suppliers_id',
        'msbranch_id',
        'ms_activitiescategorys_id',
        'activity_name',
        'sortdescription',
        'description',
        'pickup_time',
        'drop_time',
        'is_active',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'uid' => 'string',
        'pickup_time' => 'datetime',
        'drop_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        $user = Auth::user();

        parent::boot();

        static::creating(function ($model) {
            $model->created_by = $user->id ?? 1;
            $model->updated_by = $user->id ?? 1;
        });

        static::updating(function ($model) {
            $model->updated_by = $user->id ?? 1;
        });
        static::deleting(function ($model) {
            $model->deleted_by = $user->id ?? 1;
            $model->save();
        });
    }

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

    public function language()
    {
        return $this->belongsTo(MsLanguage::class);
    }

    public function ActivitiesSubs(): HasMany
    {
        return $this->HasMany(MsActivitiessub::class, 'ms_activities_id', 'id');
    }

    public function ActivitiesDescriptions(): HasMany
    {
        return $this->HasMany(MsActivitiesdescriptions::class, 'ms_activities_id', 'id');
    }
}
