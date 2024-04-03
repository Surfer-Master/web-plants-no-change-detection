<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NodeSendLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'node_id', 'id');
    }

    public function bandwidth(): BelongsTo
    {
        return $this->belongsTo(Bandwidth::class, 'bandwidth_id', 'id');
    }

    public function airTemperature(): HasOne
    {
        return $this->hasOne(AirTemperature::class, 'node_send_log_id', 'id');
    }

    public function humidity(): HasOne
    {
        return $this->hasOne(Humidity::class, 'node_send_log_id', 'id');
    }

    public function soilMoistures(): HasMany
    {
        return $this->hasMany(SoilMoisture::class, 'node_send_log_id', 'id');
    }
}
