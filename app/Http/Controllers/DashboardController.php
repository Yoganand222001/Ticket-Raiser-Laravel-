<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Traits\GetTickets;
use Illuminate\View\View;

class DashboardController extends Controller
{
    use GetTickets;
    public function openTicketCount(): View{

        $count = $this->ticketCount();

        return view('dashboard',compact('count'));
    }
}
