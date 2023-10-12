@foreach($activity_logs as $activity)
    <div class=" mt-2 mb-2 alert {{$activity->event == 'created' ? 'alert-success' :
                            ($activity->event == 'updated' ? 'alert-warning' : 'alert-danger') }}" role="alert" style="width: 50vw">
        {{$activity->description.'  '}}{{date(' Y/m/d \a\t h:i:s A', strtotime($activity->created_at))}}
    </div>
@endforeach

