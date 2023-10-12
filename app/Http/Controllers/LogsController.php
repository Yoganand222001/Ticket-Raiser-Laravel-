<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    public function activityLogs(Request $request, $data = null)
    {
        if ($request->ajax()) {

            if ($data) {

                $data = json_decode($data);

                $current_count = DB::table('counts')->where('id', '=', 1)->first()->activity_count;

                if ($data->count < $current_count) {

                    $latest_id = DB::table('activity_log')->latest('id')->first()->id;

                    if (isset($data->fetch) && $data->fetch == 'fetch_latest') {

                        $activity_logs = DB::table('activity_log')
                            ->where('id', '>', $data->last_id)
                            ->get();

                        return [
                            'status' => 200,
                            'latest_activities' => view('log_updates', compact('activity_logs'))->render(),
                            'counts' => $current_count,
                            'latest_id' => $latest_id,
                        ];
                    }
                    else {
                        $activity_logs = $this->get_paginated_data();

                        return [
                            'status' => 200,
                            'view' => view('logs', compact('activity_logs'))->render(),
                            'counts' => $current_count,
                            'latest_id' => $latest_id,
                            'nextPageUrl' => $activity_logs->nextPageUrl()
                        ];
                    }
                }
                else return [
                    'no_changes' => true,
                    'status' => 200
                ];
            }
            else
            {
                $activity_logs = $this->get_paginated_data();

                return [
                    'status' => 200,
                    'old_activities' => view('log_updates', compact('activity_logs'))->render(),
                    'is_old_activity' => true,
                    'nextPageUrl' => $activity_logs->nextPageUrl()
                ];
            }
        }
        return view('ticket_logs');
    }
    public function get_paginated_data()
    {
        return Activity::orderBy('id', 'desc')
            ->cursorPaginate(10)
            ->withPath('/ticket-logs/');
    }
}
