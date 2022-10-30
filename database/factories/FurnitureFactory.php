<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Furniture>
 */
class FurnitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->word(),
            'type' => fake()->randomElement(['chair', 'table', 'sofa']),
            'color' => fake()->colorName,
            'material' => fake()->randomElement(['wood', 'plastic', 'metal']),
        ];
    }
}
