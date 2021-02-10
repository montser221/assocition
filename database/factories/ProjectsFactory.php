<?php

namespace Database\Factories;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProjectsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Projects::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'projectName' => Str::random(15),
            'projectCategoryId' => 1,
            'whatsapp' => 00,
            'projectDesc' => Str::random(50),
            'projectLocation' => Str::random(10),
            'projectIcon' => '1611400209913525057231.jpeg',
            'projectImage' =>  '1611400211597139731709.png',
            'projectText' => Str::random(150),
            'projectCost' => 120000,
            'projectStatus' => 1,
        ];
    }
}
