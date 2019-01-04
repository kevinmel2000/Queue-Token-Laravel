<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class MainController extends Controller
{
    public function redirect(Request $request)
    {
    	if(\Auth::user()) {
    		return redirect()->route('dashboard');
    	} else {
    		return redirect()->route('get_login');
    	}
    }

    public function changeLocale(Request $request, $locale)
    {
        $locale = Language::where('code', $locale)->first();
        if($locale) {
            $request->session()->put('locale', $locale->code);
        }
        return redirect()->back();
    }
}
