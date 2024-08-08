<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'mentor_id',
        'name',
        'duration',
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function watchTimes(): HasMany
    {
        return $this->hasMany(WatchTime::class);
    }

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class, 'pivot_subscription_classes');
    }
}
