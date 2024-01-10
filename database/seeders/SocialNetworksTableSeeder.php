<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $networks = [
            [ 'key' => 'facebook', 'name' => 'Facebook', 'icon' => 'facebook', 'type' => 'url' ],
            [ 'key' => 'snapchat', 'name' => 'Snapchat', 'icon' => 'snapchat', 'type' => 'username' ],
            [ 'key' => 'tiktok', 'name' => 'Tiktok', 'icon' => 'tiktok', 'type' => 'username' ],
            [ 'key' => 'whatsapp', 'name' => 'Whatsapp', 'icon' => 'whatsapp', 'type' => 'phone' ],
            [ 'key' => 'instagram', 'name' => 'Instagram', 'icon' => 'instagram', 'type' => 'username' ],
            [ 'key' => 'twitter', 'name' => 'Twitter (X)', 'icon' => 'twitter', 'type' => 'username' ],
            [ 'key' => 'youtube', 'name' => 'Youtube', 'icon' => 'youtube', 'type' => 'url' ],
            [ 'key' => 'podcast', 'name' => 'Podcast', 'icon' => 'podcast', 'type' => 'url' ],
            [ 'key' => 'spotify', 'name' => 'Spotify', 'icon' => 'spotify', 'type' => 'url' ],
            [ 'key' => 'skype', 'name' => 'Skype', 'icon' => 'skype', 'type' => 'username' ],
            [ 'key' => 'app-store', 'name' => 'App Store', 'icon' => 'app-store', 'type' => 'url' ],
            [ 'key' => 'google-play', 'name' => 'Google Play', 'icon' => 'google-play', 'type' => 'url' ],
            [ 'key' => 'address', 'name' => 'Address', 'icon' => 'location', 'type' => 'address' ],
            [ 'key' => 'linkedin', 'name' => 'Linkedin', 'icon' => 'linkedin', 'type' => 'url' ],
            [ 'key' => 'email', 'name' => 'Email', 'icon' => 'email', 'type' => 'email' ],
            [ 'key' => 'phone', 'name' => 'Phone', 'icon' => 'phone', 'type' => 'phone' ],
            [ 'key' => 'website', 'name' => 'Website', 'icon' => 'website', 'type' => 'url' ],
            [ 'key' => 'file', 'name' => 'File', 'icon' => 'pdf', 'type' => 'url' ],
            [ 'key' => 'custom', 'name' => 'Custom', 'icon' => 'custom', 'type' => 'url']
        ];

        foreach ($networks as $network) {
            DB::table('social_networks')->updateOrInsert(
                ['key' => $network['key']],
                $network
            );
        }
    }
}