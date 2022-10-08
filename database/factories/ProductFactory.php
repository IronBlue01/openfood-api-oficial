<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'       => '12345',
            'status'     => 'imported',
            'imported_t' => '2022-10-20 12:56:54'
        ];
    }
}
