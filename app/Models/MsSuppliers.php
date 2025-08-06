<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsSuppliers extends Model
{
    //
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
    public function MsContactsuppliers(): HasMany
    {
        return $this->HasMany(MsContactsuppliers::class, 'ms_suppliers_id', 'id');
    }
}
