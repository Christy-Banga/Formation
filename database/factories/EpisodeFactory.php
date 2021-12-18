<?php

namespace Database\Factories;

use App\Models\Episode;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Episode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph(12),
            'video_url' => 'mavideo.com/' .rand(10,255),
            'formation_id' => Formation::all()->random()->id
        ];
    }
}
