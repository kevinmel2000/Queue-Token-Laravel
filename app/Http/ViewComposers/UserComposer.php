<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class UserComposer
{

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if($user = \Auth::guard('users')->user()) {
            $view->with('user', $user);
        }
    }
}
