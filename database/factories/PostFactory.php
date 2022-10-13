<?php

namespace Database\Factories;

use Faker\Core\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'title'=>$this->faker->unique()->sentence(),
            'description'=>$this->faker->realText($maxNbChars=50),
            'body'=>$this->faker->text(),
            'view'=>0,
            'category_id'=>12,
            'tags'=>$this->faker->name,
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
        ];
    }
}
