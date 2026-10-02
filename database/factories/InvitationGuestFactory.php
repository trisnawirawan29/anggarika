<?php

namespace Database\Factories;

use App\Models\InvitationGuest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvitationGuest>
 */
class InvitationGuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => null,
            'phone' => fake()->numerify('08##########'),
            'is_active' => true,
        ];
    }
}
