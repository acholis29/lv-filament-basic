<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsContactsuppliers extends Model
{
    // protected $table = 'ms_contactsuppliers';
    protected $fillable = [
        'ms_suppliers_id',
        'name',
        'email',
        'phone',
        'phone2',
        'jobtitle',
        'is_active',
    ];
    public function MsSuppliers()
    {
        return $this->belongsTo(MsSuppliers::class);
    }
}
