@extends('layouts.layout-with-sidebar_menu')
@section('body')
     @include('layouts.navbar')
     <h1 style="margin-left: 40vh;">Categories</h1>
     <h4 style="margin-left: 40vh;" class="badge {{session()->get('work_done') == 'category deleted successfully' ? 'bg-danger' : 'bg-success'}} font-semibold">
         {{session()->get('work_done')}}
     </h4>

    <!--Create Category-->
    <x-card>
        <x-slot name="card_head">
            <h4>Create Category</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('category.create')}}" >
                @csrf

                <!-------- Category name  ------->
                <div class="form-group mt-2">
                    <label for="category-name">Name</label>
                    <input type="text" class="form-control" name="category-name" id="category-name" aria-describedby="title" placeholder="Enter category name ...">
                    <small id="title" class="form-text text-muted">The title must be atleast five characters</small>
                </div>
                @error('category-name')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="create-category">Create</button>
                </div>

            </form>
        </x-slot>
    </x-card>

    <!--Edit Category-->
    <x-card>
        <x-slot name="card_head">
            <h4>Edit Category</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('category.edit')}}">
                @csrf
                @method('PUT')

                <!--existing categories dropdown-->
                <label class="my-1 mr-2 mt-2" for="category-select">Categories</label>
                <select class="custom-select my-1 mr-sm-2" name="category" id="category-select">
                    <option value={{null}}>select category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
                @error('category')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <!--Re-name the category-->
                <div class="form-group mt-2">
                    <label for="category-name">Name</label>
                    <input type="text" class="form-control" name="category-rename" id="category-name" aria-describedby="title" placeholder="Re-name the category">
                    <small id="title" class="form-text text-muted">The title must be atleast five characters</small>
                </div>
                @error('category-rename')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="edit-category">Update</button>
                </div>
            </form>
        </x-slot>
    </x-card>

    <!--Delete Category-->
    <x-card>
        <x-slot name="card_head">
            <h4>Delete Category</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('category.delete')}}">
                @csrf
                @method('DELETE')

                <!--existing categories dropdown-->
                <label class="my-1 mr-2 mt-2" for="category-select">Categories</label>
                <select class="custom-select my-1 mr-sm-2" name="delete_category" id="category-select">
                    <option value={{null}}>select category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
                @error('delete_category')
                <div class="text-danger">{{$message}}</div>
                @enderror

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-danger" id="delete-category">Delete</button>
                </div>
            </form>
        </x-slot>
    </x-card>
@endsection
