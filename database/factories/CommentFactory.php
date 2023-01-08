<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Database\Factories\Helper\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //get count of model 
        $postID = FactoryHelper::getRandomId(Post::class);
        return [
            //
            'user_id' => FactoryHelper::getRandomId(User::class),
            'post_id' => $postID
        ];
    }
}
