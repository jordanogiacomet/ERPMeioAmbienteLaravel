<?php

namespace App\Providers;

use App\Repositories\ClienteRepository;
use App\Repositories\ClienteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrar a interface e sua implementacao no container de servicos promove uma flexibilidade e manutencao de software.
        // A interface define os metodos mas nao como eles devem ser implementados;
        // A implementacao concreta permite que eu mostre quais sao os metodos e eu possa usar a interface
        // Segue os principios do solid, mostra que modulos de alto nivel devem depender de interfaces e nao de implementacoes;
        $this->app->bind(
            ClienteRepositoryInterface::class,
            ClienteRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
