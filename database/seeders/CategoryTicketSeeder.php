<?php

namespace Database\Seeders;

use App\Models\CategoryTicket;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTicketSeeder extends Seeder
{
    public function run()
    {
        $tickets = Ticket::all();

        foreach ($tickets as $ticket){
            CategoryTicket::create([
                'ticket_id' => $ticket->id,
                'category_id' => DB::table('categories')->pluck('id')->random(),
            ]);
        }

    }
}
