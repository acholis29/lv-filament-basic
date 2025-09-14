<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class MsSuppliers extends Model
{
    //
    use SoftDeletes;
    use Notifiable;

    protected $table = 'ms_suppliers';
    protected $fillable = [
        'supplier_name',
        'address',
        'ms_country_id',
        'ms_state_id',
        'ms_city_id',
        'phone',
        'phone2',
        'email',
        'website',

    ];
    protected $casts = [
        'is_active' => 'boolean',
        'uid' => 'string',
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


    public function MsCountry()
    {
        return $this->belongsTo(MsCountry::class);
    }
    public function MsState()
    {
        return $this->belongsTo(MsState::class);
    }
    public function MsCity()
    {
        return $this->belongsTo(MsCity::class);
    }
    public function ContactSuppliers(): HasMany
    {
        return $this->HasMany(MsContactsuppliers::class, 'ms_suppliers_id', 'id');
    }
}
