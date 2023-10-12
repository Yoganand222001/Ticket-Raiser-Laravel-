@extends('layouts.layout')
@section('content')
    @include('layouts.navbar')
    <x-card>
        <x-slot name="card_head">
            <h2 class="">
                Create Comment
            </h2>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('comments.store', $id)}}" enctype="multipart/form-data">
                @csrf

                <!-------- Title  ------->
                <div class="form-group mt-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="Enter title">
                    <small id="title" class="form-text text-muted">The title must be within 250 characters</small>
                    @error('title')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-------- Description ------->
                <div class="form-group mt-2">
                    <label for="body">Description</label>
                    <textarea class="form-control" name="description" id="body" rows="5"></textarea>
                    @error('description')
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
