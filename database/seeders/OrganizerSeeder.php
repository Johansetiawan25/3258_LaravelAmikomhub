<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizer;

class OrganizerSeeder extends Seeder
{
    public function run(): void
    {
        Organizer::create([
            'name' => 'ABP Productions',
            'logo' => null,
            'description' => 'Penyelenggara event profesional.'
        ]);

        Organizer::create([
            'name' => 'Amikom Event Organizer',
            'logo' => null,
            'description' => 'Organizer acara kampus dan umum.'
        ]);
    }
}
