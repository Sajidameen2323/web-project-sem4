<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'state' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed', 'Removed']),
            'description' => $this->faker->paragraph,
            'project_id' => 1,
            'assigned_to' => 2,
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High']),
            'effort' => $this->faker->numberBetween(1, 10),
            'target_date' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'risk' => $this->faker->randomElement(['Low', 'Medium', 'High']),
            'type' => $this->faker->randomElement(['Bug', 'Feature', 'Issue', 'Test Case']),
        ];
    }
}
