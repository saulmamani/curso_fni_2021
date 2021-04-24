<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->numberBetween($min = 1000, $max = 9999),
            'nombre' => $this->faker->streetName,
            'descripcion' => $this->faker->streetName,
            'precio' => $this->faker->randomNumber(2),
            'url_imagen' => $this->faker->imageUrl(200, 100),
            'like' => rand(0,10),
            'dislike' => rand(0,5),
        ];
    }
}
