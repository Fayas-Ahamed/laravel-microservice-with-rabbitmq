<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Jobs\TestJob;
use Illuminate\Support\Facades\App;
use App\Jobs\ProductUpdated;
use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // App::bindMethod(TestJob::class . '@handle', fn($job) => $job->handle());
        App::bindMethod(ProductCreated::class . '@handle', fn($job) => $job->handle());
        App::bindMethod(ProductUpdated::class . '@handle', fn($job) => $job->handle());
        App::bindMethod(ProductDeleted::class . '@handle', fn($job) => $job->handle());
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
