<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormConfiguration;
use App\Models\Event;

class FormConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer une configuration par défaut pour tous les événements existants
        $events = Event::all();

        foreach ($events as $event) {
            FormConfiguration::updateOrCreate(
                ['event_id' => $event->id],
                [
                    'field_config' => FormConfiguration::getDefaultConfig(),
                    'is_default' => false
                ]
            );
        }

        echo "Configuration par défaut créée pour " . $events->count() . " événements.\n";
    }
}
