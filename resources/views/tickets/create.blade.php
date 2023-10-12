@extends('layouts.layout')
@section('content')
    @include('layouts.navbar')
    <x-card>
        <x-slot name="card_head">
            <h2 class="">
                Create Ticket
            </h2>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('ticket.store')}}" enctype="multipart/form-data">
                @csrf

                <!-------- title  ------->
                <div class="form-group mt-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="Enter title">
                    <small id="title" class="form-text text-muted">The title must be within 250 characters</small>
                     @error('title')
                     <div class="text-danger">{{$message}}</div>
                     @enderror
                </div>

                <!-------- description ------->
                <div class="form-group mt-2">
                    <label for="body">Description</label>
                    <textarea class="form-control" name="description" id="body" rows="5"></textarea>
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-------- labels checkbox ------->
                <label class="mt-2 ">Select Labels :</label>
                @foreach($labels as $key=>$label)
                      <label class="checkbox-inline mt-2 mx-2" for="{{$key}}">
                         <input type="checkbox" name="labels[]" id="{{$key}}" value="{{$label->id}}">
                          {{$label->label}}
                      </label>
                @endforeach<br>
                @error('labels')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <!-------- categories checkbox ------->
                <label class="mt-2">Select Categories :</label>
                @foreach($categories as $key=>$category)
                    <label class="checkbox-inline mt-2 mx-2" for="{{'_'.$key}}">
                        <input type="checkbox" name="categories[]" id="{{'_'.$key}}" value="{{$category->id}}">
                        {{$category->category}}
                    </label>
                @endforeach<br>
                @error('categories')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <!-------- priority(High or low) ------->
                <label class="my-1 mr-2 mt-2" for="priority-set">Set priority</label>
                <select class="custom-select my-1 mr-sm-2 btn btn-outline-secondary"aria-describedby="priority" name="priority" id="priority-set">
                    <option value="{{'low'}}">low</option>
                    <option value="{{'high'}}">high</option>
                </select>
                <small class="mx-2" id="priority">set priority according to the query</small>
                @error('priority')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <!-- Files -->
                <div class="mt-2 form-group">
                    <label for="file">Upload file related to query</label>
                    <input type="file" name="user_files[]" class="form-control-file" id="file" multiple>
                    @error('user_files.*')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="create-role">Create</button>
                </div>

            </form>
        </x-slot>
    </x-card>

@endsection
