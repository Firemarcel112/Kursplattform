<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        return $this->save();
    }

    /**
     * Gibt dass Address-Objekt für die E-Mail-Adresse des Benutzers zurück.
     *
     * @return Address
     */
    public function getAddressForEmail(): Address
    {
        return new Address(
            $this->email,
            $this->name
        );
    }

    /**
     * Gibt die Initialien des Benutzers zurück
     * @return string
     */
    public function getInitialsAttribute()
    {
        return substr($this->name, 0, 2);
    }

    /**
     * Gibt den Anzeige Namen des Benutzers zurück
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        return Str::title($this->name);
    }
}
