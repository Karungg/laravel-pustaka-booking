<?php

namespace App\Providers;

use App\Services\Booking\BookingService;
use App\Services\Booking\BookingServiceImpl;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BookingServiceProvider extends ServiceProvider
{
    public $singletons = [
        BookingService::class => BookingServiceImpl::class
    ];

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
        View::share([
            'bookingService' => app()->make(BookingService::class)
        ]);
    }
}
