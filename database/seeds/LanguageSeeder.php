<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'your_email@rxample.com',
            'role' => 'A',
            'password' => bcrypt('admin'),
        ]);

        \App\Models\Language::create([
            'code' => 'gb',
            'name' => 'English',
            'display' => 'UK English Female',
            'image' => 'United-Kingdom.png',
        ]);

        \App\Models\Language::create([
            'code' => 'tr',
            'name' => 'Turkish',
            'display' => 'Turkish Female',
            'image' => 'Turkey.png',
        ]);

        \App\Models\Language::create([
            'code' => 'de',
            'name' => 'German',
            'display' => 'Deutsch Female',
            'image' => 'Germany.png',
        ]);

        \App\Models\Language::create([
            'code' => 'es',
            'name' => 'Spanish',
            'display' => 'Spanish Female',
            'image' => 'Spain.png',
        ]);

        \App\Models\Language::create([
            'code' => 'fr',
            'name' => 'French',
            'display' => 'French Female',
            'image' => 'France.png',
        ]);

        \App\Models\Language::create([
            'code' => 'in',
            'name' => 'Hindi',
            'display' => 'Hindi Female',
            'image' => 'India.png',
        ]);

        \App\Models\Language::create([
            'code' => 'it',
            'name' => 'Italian',
            'display' => 'Italian Female',
            'image' => 'Italy.png',
        ]);

        \App\Models\Language::create([
            'code' => 'pt',
            'name' => 'Portuguese',
            'display' => 'Portuguese Female',
            'image' => 'Portugal.png',
        ]);

        \App\Models\Language::create([
            'code' => 'ru',
            'name' => 'Russian',
            'display' => 'Russian Female',
            'image' => 'Russia.png',
        ]);

        \App\Models\Language::create([
            'code' => 'sa',
            'name' => 'Arabic',
            'display' => 'Arabic Male',
            'image' => 'Saudi-Arabia.png',
        ]);

        \App\Models\Language::create([
            'code' => 'sk',
            'name' => 'Slovak',
            'display' => 'Slovak Female',
            'image' => 'Slovakia.png',
        ]);

        \App\Models\Language::create([
            'code' => 'th',
            'name' => 'Thai',
            'display' => 'Thai Female',
            'image' => 'Thailand.png',
        ]);

        \App\Models\Language::create([
            'code' => 'id',
            'name' => 'Indonesian',
            'display' => 'Indonesian Female',
            'image' => 'Indonesia.png',
        ]);

        \App\Models\Setting::create([
            'language_id' => 1,
            'name' => 'Company name',
            'bus_no' => '',
            'address' => '',
            'email' => 'company_email@example.com',
            'phone' => '',
            'location' => '',
            'notification' => '',
            'size' => 35,
            'color' => '#f7184e',
            'logo' => '',
            'over_time' => 20,
            'missed_time' => 20,
        ]);
    }
}
