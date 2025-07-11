<?php

namespace App\Providers;

use App\Models\Profesores;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Route::middleware('api')->group(base_path('routes/api.php'));

        Gate::define('root', function ($user) {
            if ($user instanceof User && $user->cargos->tipos->tipo === 'superadmin') {
                return Response::allow();
            }
            return Response::deny('Usted No Esta Autorizado');
        });
        Gate::define('admins', function ($user) {
            if ($user instanceof User && $user->cargos->tipos->tipo === 'administrador') {
                return Response::allow();
            }
            return Response::deny('Usted No Esta Autorizado');
        });
        Gate::define('profesor', function ($user) {
            if ($user instanceof Profesores && $user->cargos->tipos->tipo === 'profesor') {
                return Response::allow();
            }
            return Response::deny('Usted No Esta Autorizado');
        });
    }
}
