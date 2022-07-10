<?php

namespace App\Providers;

use App\Models;
use App\TeamData\Services;
use App\TeamData\Contracts;
use App\TeamData\Repositories;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class TeamDataServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * @return void
     */
    private function registerRepositories(): void
    {
        $this->app->bind(Contracts\Repositories\GradeRepository::class, function () {
            return new Repositories\GradeRepository(new Models\Grade());
        });

        $this->app->bind(Contracts\Repositories\PositionRepository::class, function () {
            return new Repositories\PositionRepository(new Models\Position());
        });

        $this->app->bind(Contracts\Repositories\EmployeeRepository::class, function () {
            return new Repositories\EmployeeRepository(new Models\Employee());
        });
    }

    /**
     * @return void
     */
    private function registerServices(): void
    {
        $this->app->bind(Contracts\Services\EmployeeService::class, Services\EmployeeService::class);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            Contracts\Repositories\GradeRepository::class,
            Contracts\Repositories\PositionRepository::class,
            Contracts\Repositories\EmployeeRepository::class,

            Contracts\Services\EmployeeService::class,
        ];
    }
}
