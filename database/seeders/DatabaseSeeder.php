<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Factories\Helper\FactoryHelper;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('users')->truncate();
        // \App\Models\User::factory(10)->create();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->disable();
        $this->truncate('users');
        $this->truncate('posts');
        $this->truncate('comments');
        User::factory(5)->create();
        $post = Post::factory(5)->create();
        $post->each(function(Post $post){
            $post->user()->sync([FactoryHelper::getRandomId(User::class)]);
        });
        Comment::factory(5)->create();
        $this->enable();
    }
}
