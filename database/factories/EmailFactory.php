<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    public function modelName(): string
    {
        return Email::class;
    }

    public function definition(): array
    {
        return [
            'from' => $this->faker->email(),
            'to' => $this->faker->email(),
            'cc' => $this->faker->email(),
            'subject' => $this->faker->words(5, asText: true),
            'text_body' => $this->faker->paragraph(3),
        ];
    }
}
