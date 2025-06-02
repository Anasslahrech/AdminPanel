<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Materiel;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // Partage les matériels avec quantité < 5 dans toutes les vues
    View::composer('*', function ($view) {
        $materielsFaibleStock = Materiel::where('quantite', '<', 5)->get();
        $view->with('materielsFaibleStock', $materielsFaibleStock);
    });
}
}
