<?php

namespace Database\Factories;

use App\Courses\Models\Course;
use App\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Courses\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'author_id' => User::where('is_teacher', true)->get('user_id')->random()->user_id,
            'description' => fake()->text(255),
            'content' => '{"0": {"type": "text", "content": "'.fake()->text.'"},
            "1": {"type": "link", "content": "'.fake()->domainName.'"}}',
        ];
    }
}
