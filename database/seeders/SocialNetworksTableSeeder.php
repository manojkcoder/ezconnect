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
            [ 'key' => 'facebook', 'name' => 'Facebook', 'icon' => 'facebook', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'snapchat', 'name' => 'Snapchat', 'icon' => 'snapchat', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'tiktok', 'name' => 'Tiktok', 'icon' => 'tiktok', 'type' => 'username' , 'format' => 'https://www.tiktok.com/{value}'],
            [ 'key' => 'whatsapp', 'name' => 'Whatsapp', 'icon' => 'whatsapp', 'type' => 'phone' , 'format' => 'https://wa.me/{value}'],
            [ 'key' => 'instagram', 'name' => 'Instagram', 'icon' => 'instagram', 'type' => 'username' , 'format' => 'https://instagram.com/{value}'],
            [ 'key' => 'twitter', 'name' => 'Twitter (X)', 'icon' => 'twitter', 'type' => 'username' , 'format' => 'https://twitter.com/{value}'],
            [ 'key' => 'youtube_channel', 'name' => 'Youtube Channel', 'icon' => 'youtube', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'youtube_video', 'name' => 'Youtube Video', 'icon' => 'youtube', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'microsoft_teams', 'name' => 'Teams', 'icon' => 'teams', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'podcast', 'name' => 'Podcast', 'icon' => 'podcast', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'spotify', 'name' => 'Spotify', 'icon' => 'spotify', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'skype', 'name' => 'Skype', 'icon' => 'skype', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'app-store', 'name' => 'App Store', 'icon' => 'app-store', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'google-play', 'name' => 'Google Play', 'icon' => 'google-play', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'location', 'name' => 'Location', 'icon' => 'location', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'linkedin', 'name' => 'Linkedin', 'icon' => 'linkedin', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'email', 'name' => 'Email', 'icon' => 'email', 'type' => 'email' , 'format' => 'mailto:{value}'],
            [ 'key' => 'phone', 'name' => 'Phone', 'icon' => 'phone', 'type' => 'phone' , 'format' => 'tel:{value}'],
            [ 'key' => 'website', 'name' => 'Website', 'icon' => 'website', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'file', 'name' => 'File', 'icon' => 'pdf', 'type' => 'url' , 'format' => '{value}'],
            [ 'key' => 'custom', 'name' => 'Custom', 'icon' => 'custom', 'type' => 'url', 'format' => '{value}']
        ];

        foreach ($networks as $network) {
            DB::table('social_networks')->updateOrInsert(
                ['key' => $network['key']],
                $network
            );
        }
    }
}