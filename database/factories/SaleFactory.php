<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class SaleFactory extends Factory
{
    protected $model = \App\Models\Sale::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
        ];
    }
}
