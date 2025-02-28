<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(0, 50);
        return [
            'owner_id' => fn ($attributes) => $attributes['owner_id'] ?? User::factory()->create()->id,
            'is_active' => true,
            'quantity' => $quantity,
            'quantity_available' => $quantity - $this->faker->numberBetween(0, $quantity),
            'other_information' => json_encode([
                'due_date' => $this->faker->dateTimeInInterval('-90 days', '+360 days')->format('Y-m-d'),
                'code_barcode' => $this->faker->unique()->ean8(),
            ]),
            'name' => $this->faker->randomElement(config('products_names')),
            'description' => $this->faker->paragraph(12),
            'price' => $this->faker->randomFloat(2, 10),
            ];
    }
}
