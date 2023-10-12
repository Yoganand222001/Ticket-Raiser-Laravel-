<?php

namespace Database\Seeders;

use App\Models\LabelTicket;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelTicketSeeder extends Seeder
{
    public function run()
    {
        $tickets = Ticket::all();

        foreach ($tickets as $ticket){
            LabelTicket::create([
                'ticket_id' => $ticket->id,
                'label_id' => DB::table('labels')->pluck('id')->random(),
            ]);
        }
    }
}
