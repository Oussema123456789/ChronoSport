<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class TemplateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Composer pour le template admin
        View::composer('admin.template', function ($view) {
            // S'assurer que $event et $epreuves existent toujours
            if (!$view->offsetExists('event')) {
                $view->with('event', null);
            }

            if (!$view->offsetExists('epreuves')) {
                $view->with('epreuves', collect());
            }
        });
    }
}
