<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoilMoisture extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function plant(): BelongsTo
    {
        return $this->belongsTo(plant::class, 'plant_id', 'id');
    }

    public function nodeSendLog(): BelongsTo
    {
        return $this->belongsTo(NodeSendLog::class, 'node_send_log_id', 'id');
    }
}
