<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Health extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "health_status";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'calorie',
        'height',
        'weight',
        'fat',
        'remarks',
        'id_user',
    ];

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('backend.sidebar.health');
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

    public function Customers()
    {
        return $this->belongsTo(Customers::class, 'id_user');
    }
}
