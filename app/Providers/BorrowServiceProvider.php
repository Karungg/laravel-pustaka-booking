<?php

namespace App\Providers;

use App\Services\Borrow\BorrowService;
use App\Services\Borrow\BorrowServiceImpl;
use Illuminate\Support\ServiceProvider;

class BorrowServiceProvider extends ServiceProvider
{
    public $singletons = [
        BorrowService::class => BorrowServiceImpl::class
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
        //
    }
}
