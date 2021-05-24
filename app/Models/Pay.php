<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Pay extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "enrolls_to";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_plan',
        'id_user',
        'plan_date',
        'expire',
        'renewal',
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

    public function Customers()
    {
        return $this->belongsTo(Customers::class, 'id_user');
    }

    public function Plan()
    {
        return $this->belongsTo(Plan::class, 'id_plan');
    }
}
