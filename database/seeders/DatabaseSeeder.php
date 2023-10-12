<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
         /*User::factory(10)->create();

        for($i=0; $i<5; $i++){
           $this->call(AgentSeeder::class);
        }*/

        $this->call(ActivitySeeder::class);

    }
}
