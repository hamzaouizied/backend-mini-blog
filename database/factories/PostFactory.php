<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usertable = $this->usertable();

        return [
            'title'   => $this->faker->word(),
            'content' => $this->faker->text($maxNbChars = 255) ,
            'picture' => $this->faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker', true),
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



}
