<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivitySeeder extends Seeder
{

    public function run()
    {
        Activity::create([
            'log_name' => 'Ticket_Logs',
            'description' => 'The ticket with id #21 has been updated by #2',
            'subject_type' => 'App\Models\Ticket',
            'event' => 'updated',
            'subject_id' => 21,
            'causer_type' => 'App\Models\User',
            'causer_id' => 2
        ]);
    }
}
