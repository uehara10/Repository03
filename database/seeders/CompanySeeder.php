<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create(['company_name' => 'テスト会社1']);
        Company::create(['company_name' => 'テスト会社2']);
        Company::create(['company_name' => 'テスト会社3']);
    }
}
