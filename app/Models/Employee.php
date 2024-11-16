<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    

    public function country(){
        return $this->belongsTo(MsCountry::class);
    }
    public function state(){
        return $this->belongsTo(MsState::class);
    }
    public function city(){
        return $this->belongsTo(MsCity::class);
    }

}
