<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('subscribed', function(){
			return auth()->user()->hasSubscription();
        });

	    Blade::if('not_subscribed', function(){
		    return !auth()->check() || auth()->user()->hasNoSubscription();
	    });

	    Blade::if('subscription_cancelled', function(){
		    return auth()->user()->hasCancelled();
	    });

	    Blade::if('subscription_not_cancelled', function(){
		    return auth()->user()->hasNotCancelled();
	    });

	    Blade::if('team_subscription', function(){
		    return auth()->user()->hasTeamSubscription();
	    });

	    Blade::if('not_piggyback_subscription', function(){
		    return !auth()->user()->hasPiggybackSubscription();
	    });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
