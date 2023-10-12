<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => fake()->text(20),
            'description' => fake()->paragraph(),
            'user_id' => DB::table('users')->pluck('id')->random(),
            'has_files' => 'no',
            ];
    }
}
