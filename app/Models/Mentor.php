<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mentor extends Model
{
    use HasFactory;

    protected $table = 'mentors';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'revenue',
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }
}
