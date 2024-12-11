<?php

namespace App\Providers;

use App\Jobs\UpdateExpiredSubscriptions;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\QuestionCountUpdated::class => [
            \App\Listeners\UpdateQuestionCount::class,
        ],
    ];
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
        $this->app->bindMethod(
            [UpdateExpiredSubscriptions::class, 'handle'],
            function (UpdateExpiredSubscriptions $job) {
                return $job->handle();
            }
        );
        Paginator::defaultView('vendor.pagination.custom');
    }
    protected function schedule(Schedule $schedule)
    {
        // Gọi job UpdateExpiredSubscriptions sau mỗi 10 phút
        $schedule->job(new UpdateExpiredSubscriptions())->everyTenMinutes();
    }
}
