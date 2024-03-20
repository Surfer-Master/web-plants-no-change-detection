<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Node extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class, 'node_id', 'id');
    }

    public function nodeSendLogs(): HasMany
    {
        return $this->hasMany(NodeSendLog::class, 'node_id', 'id');
    }
}
