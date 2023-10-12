@extends('layouts.layout')
@section('content')
    @include('layouts.navbar')
    <x-card>
        <x-slot name="card_head">
            <h2 class="">
                Create User
            </h2>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('user.store')}}" >
                @csrf

                <!-------- name  ------->
                <div class="form-group mt-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Enter name">
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!-------- email  ------->
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby='email' placeholder="Enter valid email">
                    @error('email')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!--password-->
                <div class="form-group mt-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Password">
                    @error('password')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!--confirm-password-->
                <div class="form-group mt-2">
                    <label for="confirm-password">confirm password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="confirm-password" aria-describedby="password" placeholder="confirm password">
                    @error('password_confirmation')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <!--role assignment-->
                @hasrole('Admin')
                <label class="mt-2 ">Assign Role :</label>
                @foreach($roles as $key=>$role)
                    <label class="checkbox-inline mt-2 mx-2" for="{{$key}}">
                        <input type="checkbox" name="roles[]" id="{{$key}}" value="{{$role->name}}">
                        {{$role->name}}
                    </label>
                @endforeach<br>
                @endhasrole

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="create-role">Create</button>
                </div>

            </form>
        </x-slot>
    </x-card>
@endsection
