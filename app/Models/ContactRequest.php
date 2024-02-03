<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $appends = [
        'formatted_created_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'message',
        'title',
        'company_name',
    ];

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d M Y, h:i A');
    }
}
