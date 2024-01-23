<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'social_network_id',
        'url',
        'name',
        'order',
        'custom_icon_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function socialNetwork()
    {
        return $this->belongsTo(SocialNetwork::class);
    }

    public function clicks()
    {
        return $this->hasMany(LinkClick::class);
    }
}
