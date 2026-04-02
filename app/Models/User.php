<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'role', 'vendor_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Relationship: The shop this user OWNS
     * Named 'ownedShop' to avoid conflict with the getVendorAttribute accessor
     */
    public function ownedShop()
    {
        return $this->hasOne(Vendor::class, 'user_id');
    }

    /**
     * Relationship: The shop this user is STAFF of
     */
    public function joinedShop()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /**
     * Helper: Resolve which Vendor context the user should have access to
     * Uses relationship methods directly to avoid accessor recursion
     */
    public function getActiveVendor()
    {
        return $this->ownedShop ?: $this->joinedShop;
    }

    /**
     * Accessor: $user->vendor returns the active vendor context
     * (owned shop OR joined staff shop)
     */
    public function getVendorAttribute()
    {
        return $this->getActiveVendor();
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

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
}
