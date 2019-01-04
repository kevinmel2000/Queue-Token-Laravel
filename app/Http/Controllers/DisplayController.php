<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DisplayRepository;

class DisplayController extends Controller
{
    protected $displays;

    public function __construct(DisplayRepository $displays)
    {
        $this->displays = $displays;
    }

    public function index()
    {
        $settings = $this->displays->getSettings();

        \App::setLocale($settings->language->code);

        event(new \App\Events\TokenCalled());

        return view('display.index', [
            'data' => $this->displays->getDisplayData(),
            'settings' => $settings,
        ]);
    }

}
