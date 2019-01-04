<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class WelcomeController extends Controller
{
    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        try{
            Artisan::call('key:generate');
        }
        catch(Exception $e){
            return $this->response($e->getMessage());
        }

        return view('vendor.installer.welcome');
    }
}
