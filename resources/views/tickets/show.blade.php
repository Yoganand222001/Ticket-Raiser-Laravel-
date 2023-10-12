@extends('layouts.layout-with-sidebar_menu')
@section('body')
    @include('layouts.navbar')
    <x-card>
        <x-slot name="card_head">

            <!--User who created the ticket-->
            <h5 class="d-flex justify-content-between">
                <span>
                    {{'#'.$ticket->user->id}}
                    {{$ticket->user->name}}
                </span>

                <span>
                    <!--edit option only for the Admins and Assigned agent-->
                    @hasanyrole('Admin|Agent')
                    <a class="btn btn-primary" href="{{route('ticket.edit',$ticket->id)}}">Edit</a>
                    @endhasanyrole

                    <!--delete option only for the Admins -->
                    @hasrole('Admin')
                    <form action="{{route('ticket.destroy',$ticket->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endhasrole
                </span>
            </h5>
        </x-slot>

        <x-slot name="card_body">

            <!--Subject of the ticket-->
            <p class="font-medium">
                <strong>Subject : </strong>
                {{$ticket->title}}
            </p>

            <!--Description of the ticket-->
            <p class="font-medium">
                <strong>Description : </strong>
                {{$ticket->description}}
            </p>

            <!--Labels of the ticket-->
            <strong class="font-medium">Label :</strong>
            @foreach($ticket->labels as $label)
                <span class="mx-2 badge bg-danger ">{{$label->label}}</span>
            @endforeach <br>

            <!--Categories of the ticket-->
            <strong class="font-medium">Category :</strong>
            @foreach($ticket->categories as $category)
                <span class="mx-2 badge bg-warning ">{{$category->category}}</span>
            @endforeach <br>

            <!--user uploaded files download-->
            @if($ticket->has_files == 'yes')
                <a class="btn btn-outline-dark mt-2 mb-2" aria-describedby="files" href="{{route('files.download', $ticket->id)}}">Download files</a>
                <small id="files"> download to see the uploaded files by the {{$ticket->user->name}}</small>
            @endif
        </x-slot>
    </x-card>
    <h3 style="margin-left: 40vh">
        <span class="mx-2 mt-3">
        Comments
        <a class="btn btn-primary" href="{{route('comments.create', $ticket->id)}}">+ Add comment</a>
        </span>
    </h3>
    @foreach($ticket->comments as $comment)
        <x-card>
            <x-slot name="card_head">
                <h6>
                    <span>
                        {{$comment->user->name}}
                        @hasanyrole('Admin|Agent')
                        <span>
                            @foreach($comment->user->getRoleNames() as $role)
                                <span class="mx-2 badge bg-danger ">{{$role}}</span>
                            @endforeach
                        </span>
                        @endhasanyrole
                    </span>
                    <i class="mx-3">
                        {{date(' M\, d \o\f Y \a\t h:i:s A ' ,strtotime($comment->created_at))}}
                    </i>
                </h6>
            </x-slot>
            <x-slot name="card_body">
                <strong>
                    <h6>{{$comment->title}}</h6><br>
                    <h6>{{$comment->comments}}</h6>
                </strong>
            </x-slot>
        </x-card>
    @endforeach
@endsection
