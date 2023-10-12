<?php

namespace App\Traits;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

trait GetTickets
{
    public function identifyUserRoles()
    {
        $role = cache()->has(auth()->id() . '_role') ? cache()->get(auth()->id() . '_role') : null;

        if (! $role) {
            $role = auth()->user()->getRoleNames()->toArray();

            cache()->remember(auth()->id() . '_role', 3600, function () use ($role) {
                return $role;
            });
        }
        return $role;
    }

    public function ticketCount()
    {
       $roles = $this->identifyUserRoles();

        if (in_array('Admin', $roles)) {
            return Ticket::where('status', 'open')->count();
        }

        elseif (in_array('Agent', $roles)) {
            return Ticket::where('agent_id', auth()->id())
                ->where('status', 'open')
                ->count();
        }

        else {
            return Ticket::where('user_id', auth()->id())
                ->where('status', 'open')
                ->count();
        }
    }

    public function categoryFilter(Array $categories){

        $filtered_tickets = [];

        $categories_count = count($categories);

        $filtered_ticket_ids = DB::table('category_ticket')
            ->selectRaw('ticket_id, count(ticket_id)')
            ->groupBy('ticket_id')
            ->having('count(ticket_id)', '=', $categories_count)
            ->get()
            ->toArray();

        if($filtered_ticket_ids){

            foreach ($filtered_ticket_ids as $key => $ticket) {
                $filtered_tickets[$key] = $ticket->ticket_id;
            }

            $desired_filter = DB::table('category_ticket')
                ->selectRaw('ticket_id, count(ticket_id)')
                ->whereIn('ticket_id', $filtered_tickets)
                ->whereIn('category_id', $categories)
                ->groupBy('ticket_id')
                ->having('count(ticket_id)', '=', $categories_count)
                ->get()
                ->toArray();

            if(!$desired_filter) return [];
        }

        else  return [];

        $filtered_tickets = [];

        foreach ($desired_filter as $key => $ticket) {
            $filtered_tickets[$key] = $ticket->ticket_id;
        }

        return $filtered_tickets;
    }

    public function getTickets(Array $status, Array $priority, Array $categories)
    {
        $roles = $this->identifyUserRoles();

        $filtered_tickets = [];

        if($categories) {
            $filtered_tickets = $this->categoryFilter($categories);
            if(!$filtered_tickets) return collect([]);
        }

        if (in_array('Admin', $roles))
        {
            if($filtered_tickets) {
                return Ticket::whereIn('id', $filtered_tickets)
                    ->whereIn('status', $status)
                    ->whereIn('priority', $priority)
                    ->with([
                        'user',
                        'categories' => fn($query) => $query->withTrashed(),
                        'labels' => fn($query) => $query->withTrashed()
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10, ['*'], 'filter-page');
            }

            return Ticket::whereIn('status', $status)
                ->whereIn('priority', $priority)
                ->with([
                    'user',
                    'categories' => fn($query) => $query->withTrashed(),
                    'labels' => fn($query) => $query->withTrashed()
                ])
                ->orderBy('created_at', 'desc')
                ->paginate(10, ['*'], 'filter-page');
        }

        else if (in_array('Agent', $roles))
        {
            if($filtered_tickets ) {
                return Ticket::whereIn('id', $filtered_tickets)
                    ->where('agent_id', auth()->id())
                    ->whereIn('status', $status)
                    ->whereIn('priority', $priority)
                    ->with([
                        'user',
                        'categories' => fn($query) => $query->withTrashed(),
                        'labels' => fn($query) => $query->withTrashed()
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10, ['*'], 'filter-page');
            }

            return Ticket::where('agent_id', auth()->id())
                ->whereIn('status', $status)
                ->whereIn('priority', $priority)
                ->with([
                    'user',
                    'categories' => fn($query) => $query->withTrashed(),
                    'labels' => fn($query) => $query->withTrashed()
                ])
                ->orderBy('created_at', 'desc')
                ->paginate(10, ['*'], 'filter-page');
        }

        else
        {
            if($filtered_tickets){
                return Ticket::whereIn('id', $filtered_tickets)
                    ->where('user_id', auth()->id())
                    ->whereIn('status', $status)
                    ->whereIn('priority', $priority)
                    ->with([
                        'user',
                        'categories' => fn($query) => $query->withTrashed(),
                        'labels' => fn($query) => $query->withTrashed()
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10, ['*'], 'filter-page');
            }

            return Ticket::where('user_id', auth()->id())
                ->whereIn('status', $status)
                ->whereIn('priority', $priority)
                ->with([
                    'user',
                    'categories' => fn($query) => $query->withTrashed(),
                    'labels' => fn($query) => $query->withTrashed()
                ])
                ->orderBy('created_at', 'desc')
                ->paginate(10, ['*'], 'filter-page');
        }
    }

}
