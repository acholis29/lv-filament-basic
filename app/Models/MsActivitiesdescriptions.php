<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class MsActivitiesdescriptions extends Model
{
    //
    use SoftDeletes;
    use Notifiable;
    protected $fillable = [
        'ms_activities_id',
        'ms_languages_id',
        'activity_name',
        'sortdescription',
        'description',
        'is_active',
        'created_at',
        'updated_at',
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



    public function language(): HasMany
    {
        return $this->HasMany(MsLanguage::class, 'id', 'id');
    }
}
