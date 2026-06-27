<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(3, true);
        return [
            'title' => ucwords($title),
            'slug' => \Illuminate\Support\Str::slug($title),
            'description' => fake()->paragraph(2),
            'category' => fake()->randomElement(['Survival', 'Minigame', 'Lobby', 'PvP', 'Skyblock']),
            'image_url' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=' . urlencode($title),
            'external_url' => fake()->url(),
            'tags' => fake()->randomElements(['Custom GUI', 'Optimized', 'Stats Tracking', 'Multi-Arena', 'Custom Menus'], rand(2, 4)),
            'featured' => fake()->boolean(30),
            'display_order' => fake()->numberBetween(1, 100),
            'emoji' => fake()->randomElement(['🌱', '⚔️', '🏰', '🛏️', '🔪', '🧭', '⌚', '🎮']),
        ];
    }
}
