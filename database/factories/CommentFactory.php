<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usertable = $this->usertable();
        $postable = $this->postable();

        return [
            'content' => $this->faker->text($maxNbChars = 255) ,
            'post_id' => $postable::factory(),
            'user_id' => $usertable::factory(),
        ];
    }

    /**
     * @return mixed
     */
    public function usertable()
    {
        return $this->faker->randomElement([
            User::class,
        ]);
    }

    public function postable()
    {
        return $this->faker->randomElement([
            Post::class,
        ]);
    }



}
