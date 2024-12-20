<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
         protected $fillable=[
            'name'
         ];
        public function Subdepartment(): HasMany{
                return $this->HasMany(Subdepartment::class,'department_id','id');
        }
}
