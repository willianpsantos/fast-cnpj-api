<?php

namespace App\Providers;

use App\Adapters\EmpresaModelAdapter;
use App\Interfaces\EmpresaModelAdapterInterface;
use App\Interfaces\IbgeServiceInterface;
use App\Interfaces\ReceitaServiceInterface;
use App\Interfaces\UtilsServiceInterface;
use App\Services\IbgeService;
use App\Services\ReceitaService;
use App\Services\UtilsService;

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
        $this->app->bind(ReceitaServiceInterface::class, ReceitaService::class);
        $this->app->bind(IbgeServiceInterface::class, IbgeService::class);
        $this->app->bind(EmpresaModelAdapterInterface::class, EmpresaModelAdapter::class);
        $this->app->bind(UtilsServiceInterface::class, UtilsService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
