<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Surat;
use App\Models\SuratValidationStep;
use App\Observers\SuratObserver;
use App\Observers\ValidationObserver;
class EventServiceProvider extends ServiceProvider
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
        Surat::observe(SuratObserver::class);
        SuratValidationStep::observe(ValidationObserver::class);
    }
}
