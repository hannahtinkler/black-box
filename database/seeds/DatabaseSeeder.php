<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // App\Models\PageDraft::truncate();
        // App\Models\PageTag::truncate();
        // App\Models\SlugForwardingSetting::truncate();
        // App\Models\Tag::truncate();
        // App\Models\UserBadge::truncate();
        // App\Models\ResourceType::truncate();

        $this->call(CategorySeeder::class);
        $this->call(ChapterSeeder::class);
        // $this->call(BadgeSeeder::class);
        // $this->call(FeedSeeder::class);
        // $this->call(ResourceTypeSeeder::class);
    }
}
