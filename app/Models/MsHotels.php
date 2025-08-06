<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHotels extends Model
{

    protected $fillable = [
        'hotel_name',
        'address',
        'phone',
        'phone2',
        'email',
        'email2',
        'ms_country_id',
        'ms_state_id',
        'ms_city_id',
        'is_active',
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
}
