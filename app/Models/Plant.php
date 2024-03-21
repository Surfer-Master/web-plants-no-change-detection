<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'node_id', 'id');
    }

    public function soilMoistures(): HasMany
    {
        return $this->hasMany(SoilMoisture::class, 'plant_id', 'id');
    }

    public function latestSoilMoisture(): HasOne
    {
        return $this->hasOne(SoilMoisture::class)->latestOfMany();
    }
}
