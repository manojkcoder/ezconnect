<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\WelcomeEmailNotification;
use App\Notifications\ContactRequestNotification;
use App\Notifications\CustomResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'user_type',
        'company_name',
        'title',
        'email',
        'banner_picture',
        'bio',
        'profile_picture',
        'logo',
        'is_blocked',
        'customization',
        'custom_tnc',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'customization' => 'json',
    ];

    /**
     * 
     * Redirect the user to the appropriate dashboard.
     * 
     */
    public function redirectTo(): string    
    {
        return match ($this->user_type) {
            'admin' => '/admin',
            default => '/dashboard',
        };
    }


    /**
     * Get the user's social networks.
     */
    public function socialNetworks()
    {
        return $this->hasMany(UserSocialNetwork::class)->orderBy('order');
    }

    /**
     * Get the user's contact requests.
     */
    public function contactRequests()
    {
        return $this->hasMany(ContactRequest::class);
    }


    /**
     * Send the welcome email notification.
     *
     * @return void
     */
    public function sendWelcomeEmailNotification($token)
    {
        $this->notify(new WelcomeEmailNotification($token));
    }

    /**
     * Send the contact request notification.
     *
     * @return void
     */
    public function sendContactRequestNotification($contactRequest)
    {
        $this->notify(new ContactRequestNotification($contactRequest));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}
