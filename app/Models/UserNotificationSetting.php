<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserNotificationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_type',
        'is_enabled',
        'frequency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}