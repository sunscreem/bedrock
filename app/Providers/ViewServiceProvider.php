<?php

namespace App\Providers;

use App;
use Route;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.partials.common-head'], function ($view) {
            $view->with('pagetitle', $this->getPageTitle($view));
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function getPageTitle($view)
    {
        if (! Route::getCurrentRoute()) {
            return;
        }

        $title = config('page-titles.namedroutes.'.Route::getCurrentRoute()->getName(), '');

        if (App::environment('local') & ! $title) {
            App::abort(501, 'Missing PageTitle Error For Route Named "'.Route::getCurrentRoute()->getName().'"');
        }

        return $title.config('page-titles.appendtotitle');
    }
}
