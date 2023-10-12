<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;

class TicketObserver
{

    /*
     *  This observer runs the corresponding model events after all the transactions respective to the Tickets table completed.
     *
     *  The counts table consists of single row which will be locked (cannot be selected or updated) while an observer is utilizing and changing the counts row in the table,
        and after it's update it'll be released.
     *
     */

    protected $afterCommit = true;

    public function created()
    {
        DB::table('counts')
            ->where('id', '=', 1)
            ->lockForUpdate()
            ->incrementEach([
                 'tickets_count' => 1,
                 'activity_count' => 1,
             ]);
    }

    public function updated()
    {
        DB::table('counts')
            ->where('id', '=' ,1)
            ->lockForUpdate()
            ->increment('activity_count');
    }
    public function deleted()
    {
        DB::table('counts')
            ->where('id', '=' , 1)
            ->lockForUpdate()
            ->incrementEach([
                'tickets_count' => -1,
                'activity_count' => 1,
            ]);
    }
}
