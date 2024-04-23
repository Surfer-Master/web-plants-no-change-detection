<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function oldestNodeSendLog(): HasOne
    {
        return $this->hasOne(NodeSendLog::class, 'node_id', 'id')->oldestOfMany();
    }

    public function latestNodeSendLog(): HasOne
    {
        return $this->hasOne(NodeSendLog::class, 'node_id', 'id')->latestOfMany();
    }

    // public function oldestNodeSendLog($startDateTime = null, $endDateTime = null): HasOne
    // {
    //     return $this->hasOne(NodeSendLog::class, 'node_id', 'id')->ofMany(
    //         ['created_at' => 'min', 'id' => 'min',],
    //         function ($query) use ($startDateTime, $endDateTime) {
    //             $query->when($startDateTime && $endDateTime, function ($query) use ($startDateTime, $endDateTime) {
    //                 $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
    //             });
    //         }
    //     );
    // }

    // public function latestNodeSendLog($startDateTime = null, $endDateTime = null): HasOne
    // {
    //     return $this->hasOne(NodeSendLog::class, 'node_id', 'id')->ofMany(
    //         ['created_at' => 'max', 'id' => 'max',],
    //         function ($query) use ($startDateTime, $endDateTime) {
    //             $query->when($startDateTime && $endDateTime, function ($query) use ($startDateTime, $endDateTime) {
    //                 $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
    //             });
    //         }
    //     );
    // }
}
