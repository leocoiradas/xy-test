<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use APP\Models\Employee;

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
    public function definition(): array{
        $status = $this->faker->randomElement(['Completed', 'Pending', 'Blocked', 'In progress']);
        return [
            'employee_id' =>Employee::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(2),
            'status' => $status
        ];
    }
}
