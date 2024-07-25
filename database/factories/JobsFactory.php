<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jobs>
 */
class JobsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Menghasilkan tanggal close
        $closeDate = $this->faker->dateTimeBetween('now', '+1 year');

        // Menghasilkan tanggal start yang satu bulan sebelum tanggal close
        $startDate = (clone $closeDate)->modify('-1 month');

        return [
            'img' => $this->faker->imageUrl($width = 640, $height = 480),
            'name' => $this->faker->randomElement(['PHP Developer', 'Java Developer', 'Angular Developer', 'DevOps', 'Quality Assurance', 'Front-End Developer', 'Project Manager']),
            'type' => $this->faker->randomElement(['Developer', 'Non Developer']),
            'descriptions' => $this->faker->paragraph(),
            'requirements' => $this->faker->paragraph(),
            'salary' => $this->faker->randomFloat(2, 30000, 100000),
            'start' => $startDate->format('Y-m-d'),
            'close' => $closeDate->format('Y-m-d'),
            'placement' => $this->faker->randomElement(['yogyakarta', 'jakarta', 'semarang']),
            'status' => $this->faker->randomElement(['fulltime', 'internship', 'partime']),
        ];
    }
}
