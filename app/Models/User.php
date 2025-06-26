<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'photo',
        'role',
        'telephone',
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
     * The attributes that should be cast.
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
     * Relationship: an arbitre can participate in many events
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'arbitre_event', 'user_id', 'event_id')
                    ->withTimestamps();
    }

    /**
     * Relationship: A User can have many Paiements
     */
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    // ─────────────────────────────────────────────────────
    // Role helper methods
    // ─────────────────────────────────────────────────────

    /**
     * Is the user an admin?
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Is the user an organisateur?
     */
    public function isOrganisateur(): bool
    {
        return $this->role === 'organisateur';
    }

    /**
     * Is the user an arbitre?
     */
    public function isArbitre(): bool
    {
        return $this->role === 'arbitre';
    }
}
