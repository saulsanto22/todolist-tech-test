<?php

namespace Database\Factories;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $statuses = ['pending', 'in_progress', 'completed', 'open'];
        $priorities = ['low', 'medium', 'high'];
        $assignees = ['Saul', 'Andi', 'Budi', 'Citra', 'Dewi'];

        return [
            'title'       => $this->faker->sentence(3),
           
            'status'      => $this->faker->randomElement($statuses),
            'priority'    => $this->faker->randomElement($priorities),
            'assignee'    => $this->faker->randomElement($assignees),
            'time_tracked'=> $this->faker->numberBetween(0, 100),
            'due_date'    => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];
    }
}
