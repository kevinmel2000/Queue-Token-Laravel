<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class LanguageComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */


    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if($user = \Auth::user()) {
            $view->with([
                'languages' => \App\Models\Language::get(),
                'clocale' => \App\Models\Language::where('code', \App::getLocale())->first(),
            ]);
        }
    }
}
