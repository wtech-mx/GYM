<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class Customers extends Model
{
    use HasFactory;
    use Notifiable, InteractsWithMedia;

    protected $table = "customers";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'username',
        'gender',
        'mobile',
        'email',
        'date_birth',
        'joining_date',
    ];
}
