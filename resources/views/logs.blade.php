<h3 class="mt-3">Ticket logs</h3>
<span class="badge rounded-pill bg-warning updating">updating...</span>
<span class="badge rounded-pill bg-success no-new-updates"> Activities upto now handed</span>
<div class="ticket-logs">
    @foreach($activity_logs as $activity)
        <div class="mt-2 mb-2 alert {{$activity->event == 'created' ? 'alert-success' : ($activity->event == 'updated' ? 'alert-warning' : 'alert-danger') }}" role="alert" style="width: 50vw">
            {{$activity->description.' on '}}{{date(' Y/m/d \a\t h:i:s A', strtotime($activity->created_at))}}
        </div>
    @endforeach
</div>
{{$activity_logs->links()}}

