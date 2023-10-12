@extends('layouts.layout-with-sidebar_menu')
@section('body')
    @include('layouts.navbar')
    <h1 style="margin-left: 40vh;">labels</h1>
    <h4 style="margin-left: 40vh;" class="badge {{session()->get('work_done') == 'label deleted successfully' ? 'bg-danger' : 'bg-success'}} font-semibold">
        {{session('work_done')}}
    </h4>

    <!--Create Label-->
    <x-card>
        <x-slot name="card_head">
            <h4>Create Label</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('label.create')}}" >
                @csrf

                <!-------- Label name  ------->
                <div class="form-group mt-2">
                    <label for="label-name">Name</label>
                    <input type="text" class="form-control" name="label-name" id="label-name" aria-describedby="title" placeholder="Enter label name ...">
                    <small id="title" class="form-text text-muted">The title must be atleast five characters</small>
                </div>
                @error('label-name')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="create-label">Create</button>
                </div>

            </form>
        </x-slot>
    </x-card>

    <!--Edit Label-->
    <x-card>
        <x-slot name="card_head">
            <h4>Edit Label</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('label.edit')}}">
                @csrf
                @method('PUT')

                <!--existing labels dropdown-->
                <label class="my-1 mr-2 mt-2" for="label-select">Labels</label>
                <select class="custom-select my-1 mr-sm-2" name="label" id="label-select">
                    <option value="{{null}}">select Label</option>
                    @foreach($labels as $label)
                        <option value="{{$label->id}}">{{$label->label}}</option>
                    @endforeach
                </select>
                @error('label')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <!--Re-name the label-->
                <div class="form-group mt-2">
                    <label for="label-rename">Name</label>
                    <input type="text" class="form-control" name="label-rename" id="label-rename" aria-describedby="title" placeholder="Re-name the label">
                    <small id="title" class="form-text text-muted">The title must be atleast five characters</small>
                </div>
                @error('label-rename')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="edit-label">Update</button>
                </div>
            </form>
        </x-slot>
    </x-card>

    <!--Delete Label-->
    <x-card>
        <x-slot name="card_head">
            <h4>Delete Label</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('label.delete')}}">
                @csrf
                @method('DELETE')

                <!--existing Labels dropdown-->
                <label class="my-1 mr-2 mt-2" for="label-select">Labels</label>
                <select class="custom-select my-1 mr-sm-2" name="delete_label" id="label-select">
                    <option value="{{null}}">select Label</option>
                    @foreach($labels as $label)
                        <option value="{{$label->id}}">{{$label->label}}</option>
                    @endforeach
                </select>
                @error('delete_label')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-danger" id="delete-label">Delete</button>
                </div>
            </form>
        </x-slot>
    </x-card>
@endsection
