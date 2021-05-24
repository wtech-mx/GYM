<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Plan extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "plan";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'planName',
        'description',
        'validity',
        'amount',
    ];

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('backend.sidebar.plan');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function () {
            self::flushCache();
        });

        static::deleted(function () {
            self::flushCache();
        });
    }
}
