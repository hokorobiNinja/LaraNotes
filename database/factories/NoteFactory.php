<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $body =
            '## ' . fake()->realText(mt_rand(10, 15)) . "\n\n" .
            
            fake()->realText(300) . "\n\n" .
                            
            '### サンプルコード' . "\n" .
    
            "```php\n" .
            "class Sample\n" .
            "{\n" .
            "   public function " . fake()->word() . "()\n" .
            "   {\n" .
            "       return '" . fake()->sentence() . "';\n" .
            "   }\n" .
            "}\n" .
            "```\n\n" .

            '- ' . fake()->realText(mt_rand(10, 15)) . "\n" .
            '- ' . fake()->realText(mt_rand(10, 15)) . "\n" .
            '- ' . fake()->realText(mt_rand(10, 15)) . "\n\n" .
    
            fake()->realText(100);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => fake()->realText(mt_rand(10, 15)),
            'body' => $body,
        ];
    }
}
