<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\AuthRepository;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\MenuRepository;
use App\Repositories\MenuRepositoryInterface;
use App\Repositories\PaymentRepository;
use App\Repositories\PaymentRepositoryInterface;
use App\Repositories\PTRepository;
use App\Repositories\PTRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\CustomerService;
use App\Services\MenuService;
use App\Services\PaymentService;
use App\Services\PTService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(PTRepositoryInterface::class, PTRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(CustomerService::class, function ($app) {
            return new CustomerService($app->make(CustomerRepositoryInterface::class));
        });

        // Binding untuk Services
        $this->app->bind(MenuService::class, function ($app) {
            return new MenuService($app->make(MenuRepositoryInterface::class));
        });

        $this->app->bind(PaymentService::class, function ($app) {
            return new PaymentService($app->make(PaymentRepositoryInterface::class));
        });

        $this->app->bind(PTService::class, function ($app) {
            return new PTService($app->make(PTRepositoryInterface::class));
        });

        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionService($app->make(TransactionRepositoryInterface::class));
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->level === 'admin' || $user->level === 'rw';
        });
        Gate::define('cashier', function (User $user) {
            return $user->level === 'cashier';
        });
    }
}
