<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
