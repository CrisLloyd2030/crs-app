<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModuleModel extends Model
{
    use HasFactory;

    protected $table = 'modules';
    
    protected $fillable = [
        'icon',
        'module_name',
        'route',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function modulePermissions() : HasMany {
        return $this->hasMany(ModulePermission::class, 'module_id');
    }
}
