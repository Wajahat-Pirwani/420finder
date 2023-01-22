<?php

namespace App\Providers;

use View;

use App\Models\Order;

use App\Models\Notifications;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrap();

//        $notifications = Notifications::where('id', Session::get('customer_id'))->get();

        view()->composer('*', function ($view)
        {
            if(Session::has('customer_id'))
            {
                $avgReview = Order::where('customer_id', Session::get('customer_id'))->avg('rating');
                $view->with('customer_rating', number_format($avgReview, 1));
            }
        });

//        View::share('notifications', $notifications);

    }
}
