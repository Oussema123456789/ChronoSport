<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormConfiguration;
use App\Models\Event;

class FormConfigurationController extends Controller
{
    /**
     * Affiche la page de configuration du formulaire pour un événement
     */
    public function edit($eventId)
    {
        $event = Event::findOrFail($eventId);
        $config = FormConfiguration::where('event_id', $eventId)->first();

        // Si pas de configuration, utiliser la configuration par défaut
        $fieldConfig = $config ? $config->field_config : FormConfiguration::getDefaultConfig();

        // Si c'est une route de test, utiliser la vue de test
        if (request()->route()->getName() === 'test.form-config.edit') {
            return view('test-form-config', compact('event', 'fieldConfig'));
        }

        return view('admin.form-config.edit', compact('event', 'fieldConfig'));
    }

    /**
     * Met à jour la configuration du formulaire
     */
    public function update(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        // Debug : voir ce qui est reçu
        \Log::info('Form config update request:', $request->all());

        // Validation des données
        $request->validate([
            'fields' => 'required|array',
        ]);

        // Préparer la configuration
        $fieldConfig = [];

        // Traiter les données reçues
        foreach ($request->input('fields', []) as $fieldName => $fieldSettings) {
            $fieldConfig[$fieldName] = [
                'enabled' => (bool) ($fieldSettings['enabled'] ?? false),
                'required' => (bool) ($fieldSettings['required'] ?? false),
            ];
        }

        \Log::info('Processed field config:', $fieldConfig);

        // Mettre à jour ou créer la configuration
        $config = FormConfiguration::updateOrCreate(
            ['event_id' => $eventId],
            ['field_config' => $fieldConfig]
        );

        \Log::info('Saved configuration:', $config->toArray());

        return redirect()->back()->with('success', 'Configuration du formulaire mise à jour avec succès !');
    }

    /**
     * Réinitialise la configuration aux valeurs par défaut
     */
    public function reset($eventId)
    {
        $event = Event::findOrFail($eventId);

        FormConfiguration::updateOrCreate(
            ['event_id' => $eventId],
            ['field_config' => FormConfiguration::getDefaultConfig()]
        );

        return redirect()->back()->with('success', 'Configuration réinitialisée aux valeurs par défaut !');
    }
}
