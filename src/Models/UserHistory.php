<?php

namespace TheBachtiarz\UserLog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheBachtiarz\Toolkit\Helper\App\Converter\ArrayHelper;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;
use TheBachtiarz\Toolkit\Helper\App\Converter\ConverterHelper;
use TheBachtiarz\UserLog\UserLogInterface;

class UserHistory extends Model
{
    use HasFactory, ArrayHelper, CarbonHelper, ConverterHelper;

    protected $fillable = ['user_id', 'log_manager_id', 'history'];

    const HISTORY_DAY_LIMIT = config(UserLogInterface::USERLOG_CONFIG_NAME . '.limit_days');

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

    public function scopeGetUserHistoryLastDays($query, int $userId, int $days = self::HISTORY_DAY_LIMIT): ?object
    {
        return $query->getByUserId($userId)->where('created_at', '>=', self::dbGetFullDateSubDays($days));
    }

    public function scopeGetUserHistoryByLogTypeLastDays($query, int $userId, array $logIds, int $days = self::HISTORY_DAY_LIMIT): ?object
    {
        return $query->getUserHistoryLastDays($userId, $days)->whereIn('log_manager_id', $logIds);
    }

    // ? Relation
    public function user()
    {
        return $this->belongsTo(config(UserLogInterface::USERLOG_CONFIG_NAME . '.user_class')::class, 'user_id');
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
