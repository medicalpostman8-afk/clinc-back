<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'name' => [
                'ar' => 'خليج للبرمجيات',
                'en' => fake('en_US')->words(3, true),
            ],
            'description' => [
                'ar' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد',
                'en' => fake('en_US')->paragraph(),
            ],
            'address' => [
                'ar' => fake()->address(),
                'en' => fake('en_US')->address(),
            ],
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'keywords' => [
                'ar' => 'برمجيات, تصميم مواقع',
                'en' => implode(', ', fake('en_US')->words(3))
            ],
            'facebook_url' => fake()->url(),
            'twitter_url' => fake()->url(),
            'instagram_url' => fake()->url(),
            'landing_page' => [
                'ar' => [
                    'welcome_message_title' => 'نحن نصنع الافكار',
                    'welcome_message' => 'كيف يمكننا مساعدة نشاطك التجاري؟',
                    'welcome_message_description' => 'لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد',
                ],
                'en' => [
                    'welcome_message_title' => 'We create ideas',
                    'welcome_message' => 'How can we help your business?',
                    'welcome_message_description' => 'Laborum qui cumque et eos voluptatem. Laudantium similique autem et consectetur ullam error commodi. Repudiandae id delectus molestias vitae ratione dolorem.',
                ]
            ]
        ]);

        Cache::forget('settings');

        Cache::rememberForever('settings', fn() => Settings::first());

        Cache::forever('light_mode_logo', asset('images/logo/light_mode_logo.png'));
        Cache::forever('dark_mode_logo', asset('images/logo/dark_mode_logo.png'));
        Cache::forever('icon', asset('images/icons/default.png'));
    }
}
