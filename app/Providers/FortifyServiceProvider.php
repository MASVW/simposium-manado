<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Menambahkan aturan validasi khusus untuk login
        Validator::extend('email_exists', function ($attribute, $value, $parameters, $validator) {
            // Implementasikan logika pengecekan apakah email sudah terdaftar
            // Jika belum terdaftar, kembalikan false
            // Jika terdaftar, kembalikan true
            return false; // Ganti dengan logika sesuai kebutuhan
        });

        // Menambahkan pesan error khusus untuk aturan validasi email_exists
        Validator::replacer('email_exists', function ($message, $attribute, $rule, $parameters) {
            return 'Maaf, email yang Anda masukkan belum terdaftar. Pastikan Anda telah mendaftar atau coba email lain.';
        });

        
    }
}
