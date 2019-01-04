<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...

        View::composer(
            'user.*', 'App\Http\ViewComposers\UserComposer'
        );

        view()->composer(
            'user.*', 'App\Http\ViewComposers\LanguageComposer'
        );

        view()->composer(
            'user.*', 'App\Http\ViewComposers\CompanyComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
