@extends('layouts.layout')
@section('content')
    @include('layouts.navbar')
    <x-card>
        <x-slot name="card_head">
            <h2 class="">
                Edit Ticket
            </h2>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('ticket.update', $ticket->id)}}" >
                @csrf
                @method('PUT')
                <!-------- Title  ------->
                <div class="form-group mt-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="{{$ticket->title}}" placeholder="Enter title">
                    <small id="title" class="form-text text-muted">The title must be within 250 characters</small>
                    @error('title')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-------- Description ------->
                <div class="form-group mt-2">
                    <label for="body">Description</label>
                    <textarea class="form-control" name="description" id="body" rows="5">{{$ticket->description}}</textarea>
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-------- Labels checkbox ------->
                <label class="mt-2 ">Select Labels :</label>
                @foreach($labels as $key=>$label)
                    <label class="checkbox-inline mt-2 mx-2" for="{{$key}}">
                        <input type="checkbox" name="labels[]" id="{{$key}}" value="{{$label->id}}" {{in_array($label->label, $labels_of_the_ticket) ? 'checked' : ''}}>
                        {{$label->label}}
                    </label>
                @endforeach<br>
                @error('labels')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <!-------- Categories checkbox ------->
                <label class="mt-2">Select Categories :</label>
                @foreach($categories as $key=>$category)
                    <label class="checkbox-inline mt-2 mx-2" for="{{'_'.$key}}">
                        <input type="checkbox" name="categories[]" id="{{'_'.$key}}" value="{{$category->id}}" {{in_array($category->category, $categories_of_the_ticket) ? 'checked' : ''}}>
                        {{$category->category}}
                    </label>
                @endforeach<br>
                @error('$categories')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <!-------- set status(open or close) ------->
                <label class="my-1 mr-2 mt-2" for="status-set">Set status</label>
                <select class="custom-select my-1 mr-sm-2 btn btn-outline-secondary" name="status" id="status-set">
                    <option value="{{'open'}}" {{$ticket->status == 'open' ? 'selected' : '' }}>open</option>
                    <option value="{{'closed'}}" {{$ticket->status == 'closed' ? 'selected' : '' }}>close</option>
                </select>

                <!-------- select Agent (only for Admins) ------->
                @hasrole('Admin')
                <label class="my-1 mr-2 mt-2" for="agent-select">Assign agent</label>
                <select class="custom-select my-1 mr-sm-2" name="agent" id="agent-select" >
                    <option value="{{0}}">select Agent</option>
                    @foreach($agents as $agent)
                        <option value="{{$agent->id}}" {{$ticket->agent_id == $agent->id ? 'selected' : '' }}>{{$agent->name}}</option>
                    @endforeach
                    @error('agent')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </select>

                @endhasrole

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="create-role">Update</button>
                </div>

            </form>
        </x-slot>
    </x-card>

@endsection

