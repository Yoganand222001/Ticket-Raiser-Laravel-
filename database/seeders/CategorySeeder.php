<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {
        $categories = ['uncategorized', 'Billing payments', 'Technical questions', 'Non-technical'];
        foreach($categories as $category){
            Category::create([
                'category' => $category
            ]);
        }
    }
}
