<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $websites = [
            [
                'url' => 'http://example.com',
                'client_id' => 1,
            ],
            [
                'url' => 'http://example.org',
                'client_id' => 2,
            ],
            [
                'url' => 'http://example.net',
                'client_id' => 3,
            ],
        ];

        foreach ($websites as $website) {
            \App\Models\Website::create($website);
        }
    }
}
