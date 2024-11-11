<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Company;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $companies = Company::all()->pluck('id');

        foreach ($companies as $company_id) {
            Product::factory(3)->create(['company_id' => $company_id]);
        }
    }
}
