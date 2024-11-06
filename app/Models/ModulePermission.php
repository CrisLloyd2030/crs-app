<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModulePermission extends Model
{
    use HasFactory;

    protected $table = 'module_permission';
    
    protected $fillable = [
        'module_id',
        'role_id',
        'created_by',
        'updated_by'
    ];

    public function roles() : BelongsTo {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
