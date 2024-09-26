<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\GeneroComponent;
use App\Http\Livewire\NestudioComponent;
use App\Http\Livewire\TdocumentoComponent;
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

        Route::get('documento', TdocumentoComponent::class)->name('documento');
        Route::get('genero', GeneroComponent::class)->name('genero');
        Route::get('nestudio', NestudioComponent::class)->name('nestudio');

    });
});
