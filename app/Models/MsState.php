<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsState extends Model
{
    //
    protected $fillable=[
        'ms_country_id',
        'name'
    ];
    public function MsCountry(){
        return $this->belongsTo(MsCountry::class,'ms_country_id','id');
    }
    public function City(): HasMany{
        return $this->HasMany(MsCity::class,'ms_state_id','id');
    }
}
