<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'evenements'; // Specify the table name

    protected $fillable = [
        'nom', 'pays', 'ville', 'adresse', 'date', 'image_couverture', 'image_profile',
        'type', 'latitude', 'longitude', 'email', 'site_web', 'tel',
        'facebook', 'instagram', 'youtube', 'description', 'reglement','user_id',
    ];

    // ✅ Define the many-to-many relationship with arbitres (users)
    public function arbitres()
    {
        return $this->belongsToMany(User::class, 'arbitre_event', 'event_id', 'user_id')
                    ->withTimestamps();
    }
    public function sponsors()
{
    return $this->hasMany(Sponsor::class, 'evenement_id');
}
public function epreuves()
{
    return $this->hasMany(Epreuve::class, 'evenement_id');
}
public function organisateur()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
