<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsCountry extends Model
{
     protected $fillable = ['name','code','phonecode'];

        public function state(): HasMany{
                return $this->HasMany(MsState::class,'ms_country_id','id');
        }
}
