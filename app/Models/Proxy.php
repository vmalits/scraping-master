<?php

namespace App\Models;

use App\QueryFilters\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Proxy
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $type
 * @property string $ip
 * @property string $port
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy filter($filters)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereType($value)
 */
class Proxy extends Model
{
    use Filterable;

    protected $fillable = ['type', 'ip', 'port'];

    public const TYPE_HTTP = 'http';
    public const TYPE_HTTPS = 'https';
    public const TYPE_SOCKS_4 = 'socks4';
    public const TYPE_SOCKS_5 = 'socks5';

    public const TYPES = [
        self::TYPE_HTTP,
        self::TYPE_HTTPS,
        self::TYPE_SOCKS_4,
        self::TYPE_SOCKS_5
    ];
}
