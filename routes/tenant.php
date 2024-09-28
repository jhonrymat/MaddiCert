<?php

declare(strict_types=1);

use App\Models\Tsolicitante;
use App\Http\Livewire\RolesComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BarrioComponent;
use App\Http\Livewire\GeneroComponent;
use App\Http\Livewire\NestudioComponent;
use App\Http\Livewire\PermisosComponent;
use App\Http\Livewire\SolicitudComponent;
use App\Http\Livewire\FormularioComponent;
use App\Http\Livewire\TdocumentoComponent;
use App\Http\Livewire\TsolicitanteComponent;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return view('welcome-tenancy');
        //return 'This is your multi-tenant application. The id of the current tenant is '.tenant('id').'. Go to <a href="/dashboard">/dashboard</a> to see the dashboard.';
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard-tenancy');
        })->name('dashboard.tenancy');

    });

    Route::middleware(['can:documento'])->get('documento', TdocumentoComponent::class)->name('documento');
    Route::middleware(['can:genero'])->get('genero', GeneroComponent::class)->name('genero');
    Route::middleware(['can:nestudio'])->get('nestudio', NestudioComponent::class)->name('nestudio');
    Route::middleware(['can:tsolicitante'])->get('tsolicitante', TsolicitanteComponent::class)->name('tsolicitante');
    Route::middleware(['can:barrio'])->get('barrio', BarrioComponent::class)->name('barrio');
    Route::middleware(['can:solicitudes'])->get('solicitudes', SolicitudComponent::class)->name('solicitudes');
    Route::middleware(['can:roles'])->get('roles', RolesComponent::class)->name('roles');
    Route::middleware(['can:permisos'])->get('permisos', PermisosComponent::class)->name('permisos');
    Route::middleware(['can:formulario'])->get('formulario', FormularioComponent::class)->name('formulario');
});
