<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsCity extends Model
{
    //
    protected $fillable = [
        // 'ms_state_id',
        // 'name'
    ];
    public function MsState()
    {
        return $this->belongsTo(MsState::class);
    }
}
