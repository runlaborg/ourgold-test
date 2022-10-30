<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Apartment;
use App\Models\AttributeFurniture;
use App\Models\Room;
use App\Models\Furniture;
use App\Models\Attribute;
use App\Models\Value;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Apartment::factory(2)->has(Room::factory(4)->sequence(
            ['type' => 'kitchen'],
            ['type' => 'bathroom'],
            ['type' => 'hallway'],
            ['type' => 'living_room'],
        )->has(Furniture::factory(2)))->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
