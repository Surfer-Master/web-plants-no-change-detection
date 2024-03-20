<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bandwidth extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function nodeSendLogs(): HasMany
    {
        return $this->hasMany(NodeSendLog::class, 'bandwidth_id', 'id');
    }
}
