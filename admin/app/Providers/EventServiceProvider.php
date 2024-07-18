<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\App;
use App\Jobs\ProductLiked;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        App::bindMethod(ProductLiked::class. '@handle', fn($job) => $job->handle());
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
