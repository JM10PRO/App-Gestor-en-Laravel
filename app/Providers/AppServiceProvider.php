<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard(); //Desactiva la protección de asignación masiva en todos los modelos de Eloquent, solo si en store y update NO pasamos $request -> all(), ya que podrían incluirse otros campos no deseados.
        Paginator::useBootstrapFive();
    }
}
