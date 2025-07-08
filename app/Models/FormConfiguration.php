<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormConfiguration extends Model
{
    protected $fillable = [
        'event_id',
        'field_config',
        'is_default'
    ];

    protected $casts = [
        'field_config' => 'array',
        'is_default' => 'boolean'
    ];

    /**
     * Relation avec Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Configuration par défaut des champs
     */
    public static function getDefaultConfig()
    {
        return [
            'nom' => ['enabled' => true, 'required' => true],
            'prenom' => ['enabled' => true, 'required' => true],
            'email' => ['enabled' => true, 'required' => true],
            'telephone' => ['enabled' => true, 'required' => true],
            'date_naissance' => ['enabled' => true, 'required' => true],
            'cin' => ['enabled' => true, 'required' => true],
            'genre' => ['enabled' => true, 'required' => true],
            'nationalite' => ['enabled' => true, 'required' => true],
            'club' => ['enabled' => true, 'required' => false],
        ];
    }

    /**
     * Obtenir la configuration pour un événement
     */
    public static function getConfigForEvent($eventId)
    {
        $config = self::where('event_id', $eventId)->first();

        if ($config) {
            return $config->field_config;
        }

        // Retourner la configuration par défaut si aucune configuration spécifique
        return self::getDefaultConfig();
    }
}
