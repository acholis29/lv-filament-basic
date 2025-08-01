<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // protected $fillable=[
    //     'nik',
    //     'full_name',
    //     'address',
    //     'phone',
    //     'email',
    //     'ms_country_id',
    //     'ms_state_id',
    //     'ms_city_id',
    //     'department_id',
    //     'subdepartment_id',
    //     'job_position',
    //     'msbranch_id',
    //     'user_id',
    //     'msreligion_id',
    //     'msmarital_id',
    //     'gender',
    //     'date_of_birth',
    //     'date_of_join',
    //     'salary',
    //     'profile_photo_path',
    //     'slug',
    //     'is_visible',
    //     'status',
    //     'idx'
    // ];

    public function MsCountry(){
        return $this->belongsTo(MsCountry::class);
    }
    public function MsState(){
        return $this->belongsTo(MsState::class);
    }
    public function MsCity(){
        return $this->belongsTo(MsCity::class);
    }

}
