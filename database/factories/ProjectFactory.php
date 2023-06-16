<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_name' => $this->faker->word,
            'subtitle' => $this->faker->randomElement(['Web App', 'Mobile App', 'Windows App', 'Server']),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(7),
            'project_manager' => 1, // Assuming 10 users in the database
            'team_lead' => 2,
            'status' => $this->faker->randomElement(['Active', 'Completed', 'Dropped', 'Postponed', 'Scheduled']),
            'priority' => $this->faker->randomElement(['High', 'Medium', 'Low']),
            'description' => $this->faker->paragraph,
            'frontend' => $this->faker->randomElement(['React', 'Vue', 'Next', 'Angular', 'Windows','Svelte']),
            'backend' => $this->faker->randomElement(['Spring', 'Next.js', 'ASP.NET', 'Flask', 'Django', 'Express']),
            'database' => $this->faker->randomElement(['Oracle', 'MySQL', 'MS SQL Server', 'PostgreSQL', 'MongoDB', 'Redis', 'Firestore']),
        ];
    }
}
