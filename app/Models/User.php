<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, InteractsWithMedia;

    /**
     * Los atributos que no son asignables en masa.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Los atributos que deben estar ocultos para las matrices.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * los Atributos Que Deben Ser Arrojados A Los Tipos Nativos
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackUrl(config('app.placeholder') . '160.png')
            ->useFallbackPath(config('app.placeholder') . '160.png')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(160)
                    ->height(160);
            });
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public static function getAllUsers()
    {
        return Cache::rememberForever('users.all', function () {
            return self::with('role')->latest('id')->get();
        });
    }

    /**
     * Enjuagar el caché
     */
    public static function flushCache()
    {
        Cache::forget('users.all');
    }

    /**
     * El método de "arranque" del modelo.
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }
}
