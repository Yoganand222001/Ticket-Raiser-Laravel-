@foreach($tickets as $key=>$ticket)
    <div class="accordion mb-2 mt-3" id="accordionExample">
        <div class="accordion-item border-dark">
            <h2 class="accordion-header " id="{{$key}}">
                <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse"
                        data-bs-target="{{'#collapse'.$key}}" aria-expanded="false" aria-controls="collapseOne">
                    <span class="mx-2 details">{{'#'.$ticket->user->id}}</span>
                    <span class="details">{{$ticket->user->name}}</span>
                    <span
                        class="details status badge bg-{{$ticket->status == 'open'? 'success':'danger'}} ">{{$ticket->status}}</span>
                    <i class="bi bi-clock "></i>
                    <span class="details time ">{{date(' Y/m/d \a\t h:i:s A', strtotime($ticket->created_at))}}</span>
                </button>
            </h2>
            <div id="{{'collapse'.$key}}" class="accordion-collapse collapse show" aria-labelledby="{{$key}}"
                 data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>
                        Priority : {{$ticket->priority}}<br>
                        Label :
                        @foreach($ticket->labels as $label)
                            <span class="mx-2 badge bg-danger ">{{$label->label}}</span>
                        @endforeach <br>
                        Category :
                        @foreach($ticket->categories as $category)
                            <span class="mx-2 badge bg-warning ">{{$category->category}}</span>
                        @endforeach <br>
                        Assigned Agent-Id:
                        @if(! $ticket->agent_id)
                            <span class="mx-2">agent assignment still in-progress</span>
                        @else
                            <span class="mx-2">{{$ticket->agent_id}}</span>
                        @endif
                    </strong><br>
                    <a class="btn checkout btn-primary" href="{{route('ticket.show',$ticket->id)}}">checkout</a>
                </div>
            </div>
        </div>
    </div>
@endforeach

@if(! $tickets->count())
    <div class="bg-warning mt-4" style="height: 25vh; margin-left: 10% ;margin-right: 20%">
        <i class="bi bi-exclamation-diamond mt-4" style="font-size:10vh; margin-left: 45%;"></i>
        <h3 style=" margin-left: 23%">No tickets are available for this filtration</h3>
    </div>
@else
    <div>{{ $tickets->links() }}</div>
@endif
<script>
    $(document).ready(function(){
        $('.page-link').on('click', function (e) {
            e.preventDefault();
            ajax_request($(this).attr('href'));
        });
    })
</script>
