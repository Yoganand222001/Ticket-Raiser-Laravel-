<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{

    public function run()
    {
        $labels = ['bug', 'speed', 'enhancement', 'question'];
        foreach($labels as $label){
            Label::create([
                'label' => $label
            ]);
        }
    }
}
