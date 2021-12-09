<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheBachtiarz\Toolkit\Helper\App\Converter\ArrayHelper;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;
use TheBachtiarz\Toolkit\Helper\App\Converter\ConverterHelper;

class UserHistory extends Model
{
    use HasFactory, ArrayHelper, CarbonHelper, ConverterHelper;

    protected $fillable = ['user_id', 'log_manager_id', 'history'];

    // ? Map
    public function simpleListMap(): array
    {
        return [
            'log_type' => self::humanLogTypeName($this->logmanager->name_type),
            'log_info' => $this->history
        ];
    }

    public function userLogHistoryListMap(): array
    {
        return $this->simpleListMap() + [
            'datetime' => [
                'date' => self::humanDateTime($this->created_at, 'date'),
                'time' => self::humanDateTime($this->created_at, 'time')
            ],
            'location' => $this->historylocation ? self::jsonDecode($this->historylocation->location) : null
        ];
    }

    // ? Scope
    public function scopeGetByUserId($query, int $userId): ?object
    {
        return $query->where('user_id', $userId);
    }

    public function scopeGetUserHistoryLastDays($query, int $userId, ?int $days = null): ?object
    {
        if (!$days) $days = tbuserlogconfig('limit_days');

        return $query->getByUserId($userId)->where('created_at', '>=', self::dbGetFullDateSubDays($days));
    }

    public function scopeGetUserHistoryByLogTypeLastDays($query, int $userId, array $logIds, ?int $days = null): ?object
    {
        if (!$days) $days = tbuserlogconfig('limit_days');

        return $query->getUserHistoryLastDays($userId, $days)->whereIn('log_manager_id', $logIds);
    }

    // ? Relation
    public function user()
    {
        return $this->belongsTo(tbuserlogconfig('user_class'), 'user_id');
    }

    public function logmanager()
    {
        return $this->belongsTo(LogManager::class, 'log_manager_id');
    }

    public function historylocation()
    {
        return $this->hasOne(HistoryLocation::class);
    }
}
