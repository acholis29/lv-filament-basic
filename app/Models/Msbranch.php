<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msbranch extends Model
{

    protected $fillable = [
        'code',
        'name',
        'address',
        'ms_country_id',
        'ms_state_id',
        'ms_city_id',
        'phone',
        'email',
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
