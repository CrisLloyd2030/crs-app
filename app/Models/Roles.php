<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';
    
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }
}
