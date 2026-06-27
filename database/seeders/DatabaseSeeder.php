<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Gallery;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create featured Minecraft projects
        Project::create([
            'title' => 'Hypixel SkyBlock Setup - COMING SOON',
            'slug' => 'hypixel-skyblock-setup',
            'description' => 'A Hypixel SkyBlock–inspired island economy setup with islands, minions, auction house & bazaar systems, slayer and dungeon mechanics, collections and progression, custom items, reforges, pets, and cooperative profiles — built for server owners who want a polished, feature-complete SkyBlock experience ready to deploy.',
            'category' => 'SkyBlock',
            'image_url' => 'https://via.placeholder.com/800x600/0ea5a4/ffffff?text=SkyBlock+Setup',
             'external_url' => 'https://builtbybit.com/resources/hypixel-skyblock-setup/',
             'tags' => [
                'Islands', 'Minions', 'Auction House', 'Bazaar', 'Slayer', 
                'Dungeons', 'Collections', 'Custom Items', 'Pets', 'Reforges', 
                'Profiles', 'Quests'
            ],
            'featured' => true,
            'display_order' => 1,
             'emoji' => '🏝️',
]);


        Project::create([
            'title' => 'RPG Weapons | EcoItems Config',
            'slug' => 'rpg-weapons-ecoitems-config',
            'description' => 'A comprehensive RPG weapons configuration for EcoItems, featuring custom stats, abilities, and integration with popular RPG plugins.',
            'category' => 'Configuration',
            'image_url' => 'https://builtbybit.com/attachments/your-paragraph-text-1-png.841210/?preset=fullr1',
            'external_url' => 'https://builtbybit.com/resources/rpg-weapons-ecoitems-config.54465',
            'tags' => ['Configuration', 'EcoItems', 'Weapons', 'RPG', 'MythicMobs'],
            'featured' => true,
            'display_order' => 2,
            'emoji' => '🗡️',
        ]);

        Project::create([
            'title' => 'RPG Armors | EcoArmor Config',
            'slug' => 'rpg-armors-ecoarmor-config',
            'description' => 'A comprehensive RPG armors configuration for EcoArmor, featuring custom stats, abilities, and integration with popular RPG plugins.',
            'category' => 'Configuration',
            'image_url' => 'https://builtbybit.com/attachments/copy-of-copy-of-your-paragraph-text-1495-x-374-px-png.852031/?preset=fullr1',
            'external_url' => 'https://builtbybit.com/resources/rpg-armors-ecoarmor-config.55805',
            'tags' => ['Configuration', 'EcoArmor', 'Armors', 'RPG', 'MythicMobs'],
            'featured' => true,
            'display_order' => 3,
            'emoji' => '🛡️',
        ]);

        Project::create([
            'title' => 'RPG Skills | EcoSkills Config - COMING SOON',
            'slug' => 'rpg-skills-ecoskills-config',
            'description' => 'A comprehensive RPG skills configuration for EcoSkills, featuring custom abilities, skill trees, and integration with popular RPG plugins.',
            'category' => 'Configuration',
            'image_url' => 'https://builtbybit.com/attachments/minecraft-skills-1-png.1100351/?preset=fullr1',
            'external_url' => 'https://builtbybit.com/resources/castle-siege-setup.4/',
            'tags' => ['Configuration', 'EcoSkills', 'Skills', 'RPG', 'MythicMobs'],
            'featured' => true,
            'display_order' => 4,
            'emoji' => '🪄',
        ]);

        // Create some additional non-featured projects
        Project::factory(6)->create(['featured' => false]);

        // Create gallery screenshots
        Gallery::create([
            'title' => 'Server Lobby Hub',
            'description' => 'Custom designed spawn area with modern aesthetic',
            'image_url' => 'https://images.unsplash.com/photo-1538481199705-c710c4e965fc?w=800&h=600&fit=crop',
            'display_order' => 1,
        ]);

        Gallery::create([
            'title' => 'KOTH Battle Arena',
            'description' => 'King of the Hill setup with competitive design',
            'image_url' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=800&h=600&fit=crop',
            'display_order' => 2,
        ]);

        Gallery::create([
            'title' => 'PvP Combat Zone',
            'description' => 'Enhanced PvP mechanics with custom arenas',
            'image_url' => 'https://images.unsplash.com/photo-1511882150382-421056c89033?w=800&h=600&fit=crop',
            'display_order' => 3,
        ]);

        Gallery::create([
            'title' => 'Custom Menu GUI',
            'description' => 'Intuitive interface design for player navigation',
            'image_url' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=800&h=600&fit=crop',
            'display_order' => 4,
        ]);

        Gallery::create([
            'title' => 'Player Stats GUI',
            'description' => 'Real-time statistics tracking system',
            'image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800&h=600&fit=crop',
            'display_order' => 5,
        ]);
    }
}
