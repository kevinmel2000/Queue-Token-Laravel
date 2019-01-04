<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Setting;

class SettingsRepository
{
    public function getLanguages()
    {
        return Language::all();
    }

    public function getSettings()
    {
        return Setting::first();
    }
}
