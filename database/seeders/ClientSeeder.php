<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Client 1',
            ],
            [
                'name' => 'Client 2',
            ],
            [
                'name' => 'Client 3',
            ],
        ];

        foreach ($clients as $client) {
            \App\Models\Client::create($client);
        }
    }
}
