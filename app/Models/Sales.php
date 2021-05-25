<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Sales extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "sales";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_product',
        'lot',
        'amount',
    ];

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('backend.sidebar.sales');
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

    public function Products()
    {
        return $this->belongsTo(Products::class, 'id_product');
    }
}
