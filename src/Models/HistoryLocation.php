<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TheBachtiarz\UserLog\Traits\Model\History\{HistoryLocationMapTrait, HistoryLocationScopeTrait};

class HistoryLocation extends Model
{
    use HistoryLocationMapTrait, HistoryLocationScopeTrait;

    protected $fillable = ['user_history_id', 'location'];

    // ? Relation
    public function userhistory(): BelongsTo
    {
        return $this->belongsTo(UserHistory::class);
    }
}
