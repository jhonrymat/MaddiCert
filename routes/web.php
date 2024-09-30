<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TenantComponent;
use App\Http\Controllers\TenantController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('tenants', TenantComponent::class)->name('tenants');
    // perfil de usuario jetstreams
    Route::get('user/profiles', [UserProfileController::class, 'show'])->name('profile.show');

});
