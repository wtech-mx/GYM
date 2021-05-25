<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Customers extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "customers";
    protected $primarykey = "id";

    protected $fillable = [
        'username',
        'id_plan',
        'gender',
        'mobile',
        'email',
        'streetName',
        'state',
        'city',
        'zipcode',
        'date_birth',
        'joining_date',
    ];

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('backend.sidebar.menu');
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

    public function Plan()
    {
        return $this->belongsTo(Plan::class, 'id_plan');
    }
}
