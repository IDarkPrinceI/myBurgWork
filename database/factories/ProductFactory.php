<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(3, true);
        return [
            'title'=> ucfirst($title),
            'category_id' => $this->faker->numberBetween(1, 4),
            'slug' => Str::slug($title, '-'),
            'price' => $this->faker->randomNumber(3, true),
            'old_price' => $this->faker->randomNumber(4, true),
            'description' => $this->faker->paragraphs(2, true),
            'is_new' => $this->faker->numberBetween(0,1),
            'is_hit' => $this->faker->numberBetween(0,1),
            'content' => $this->faker->paragraphs(1, true),
            'keywords' => $this->faker->words(4, true),
            'view' => $this->faker->numberBetween(50, 9999),
        ];
    }
}
