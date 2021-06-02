<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $isNative = $this->faker->boolean(30);
        if(!$isNative){
            $proficiencyLevels = ["Beginner", "Limited working proficiency", "Intermediate", "Proficient", "Fluent"];
            $speakingLevel = $this->faker->numberBetween(1, 5);
            $readingLevel = $this->faker->numberBetween(1, 5);
            $writingLevel = $this->faker->numberBetween(1, 5);
            $listeningLevel = $this->faker->numberBetween(1, 5);
            $averageLevel = (int) floor(($speakingLevel+$readingLevel+$writingLevel+$listeningLevel)/4);
        }
        return [
            'name' => $this->faker->languageCode,
            'rating' => $isNative ? 5 : $averageLevel,
            'speaking' => $isNative ? "Native" : $proficiencyLevels[$speakingLevel-1], 
            'reading' => $isNative ? "Native" : $proficiencyLevels[$readingLevel-1], 
            'writing' => $isNative ? "Native" : $proficiencyLevels[$writingLevel-1], 
            'listening' => $isNative ? "Native" : $proficiencyLevels[$listeningLevel-1], 
            'certificate_level' => null,
            'certificate_img_path' => null
        ];
    }
}
