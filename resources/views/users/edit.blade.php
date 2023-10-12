@extends('layouts.layout')
@section('content')
    @include('layouts.navbar')
    <x-card>
        <x-slot name="card_head">
            <h2 class="">
                Edit User
            </h2>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('user.update', $user->id)}}" >
                @csrf
                @method('PUT')

                <!-------- name  ------->
                <div class="form-group mt-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{$user->name}}" placeholder="Enter name">
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-------- email  ------->
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby='email' value="{{$user->email}}" placeholder="Enter valid email">
                    @error('email')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!--role assignment edit-->
                @hasrole('Admin')
                <label class="mt-2 ">Assign Role :</label>
                @foreach($roles as $key=>$role)
                    <label class="checkbox-inline mt-2 mx-2" for="{{$key}}">
                        <input type="checkbox" name="roles[]" value="{{$role->name}}" id="{{$key}}" {{in_array($role->name, $roles_of_user) ? 'checked' : ''}}>
                        {{$role->name}}
                    </label>
                @endforeach<br>
                @endhasrole

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="edit-role">Edit</button>
                </div>

            </form>
        </x-slot>
    </x-card>
@endsection
