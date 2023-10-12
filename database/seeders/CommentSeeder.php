<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{

    public function run()
    {
        foreach (Ticket::all() as $ticket) {

            Comment::factory(5)->create([
                'user_id' => $ticket->agent_id,
                'ticket_id' => $ticket->id,
        ]);
        }

    }
}
