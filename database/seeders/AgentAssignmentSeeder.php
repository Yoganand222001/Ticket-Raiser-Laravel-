<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AgentAssignmentSeeder extends Seeder
{
    public function run()
    {
        $agents = User::role('Agent')->pluck('id')->toArray();

        $tickets = Ticket::all();

        foreach ($tickets as $ticket){
            $ticket->update([
                'agent_id' => Arr::random($agents),
            ]);

        }

        $tickets->random()->update([
            'priority' => 'high'
        ]);

    }
}
