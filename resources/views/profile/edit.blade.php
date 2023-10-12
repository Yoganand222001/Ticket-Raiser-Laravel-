@extends('layouts.layout-with-sidebar_menu')
@section('body')
    @include('layouts.navbar')
    <h1 style="margin-left: 40vh;">Profile</h1>
    <div class="font-semibold text-success">{{session()->get('status')}}</div>
    <!--Edit user name-->
    <x-card>
        <x-slot name="card_head">
            <h4>User Profile</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('profile.update')}}" >
                @csrf
                @method('PUT')

                <!-------- User name  ------->
                <div class="form-group mt-2">
                    <label for="user-name">Name</label>
                    <input type="text" class="form-control" name="user_name" value="{{$user->name}}" id="user-name" aria-describedby="title" placeholder="Enter your name ...">
                    @error('user_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <!-------- User email  ------->
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" aria-describedby="title" placeholder="Enter valid email ...">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                 </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="update">Update</button>
                </div>

            </form>
        </x-slot>
    </x-card>

    <!--Change Password-->
    <x-card>
        <x-slot name="card_head">
            <h4>Change password</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('profile.update')}}">
                @csrf
                @method('PUT')
                <!--old password -->
                <div class="form-group mt-2">
                    <label for="password">Old password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="title" placeholder="enter old password">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <!--new password -->
                <div class="form-group mt-2">
                    <label for="new-password">New password</label>
                    <input type="password" class="form-control" name="new_password" id="new-password" aria-describedby="title" placeholder="enter new password">
                    @error('new_password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <!--confirm new password -->
                <div class="form-group mt-2">
                    <label for="confirm-new-password">confirm new password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="confirm-new-password" aria-describedby="title" placeholder="confirm new password">
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" id="edit-category">Update</button>
                </div>
            </form>
        </x-slot>
    </x-card>

    <!--Delete account-->
    <x-card>
        <x-slot name="card_head">
            <h4>Delete account</h4>
        </x-slot>
        <x-slot name="card_body">
            <form method="POST" action="{{route('profile.destroy')}}">
                @csrf
                @method('DELETE')
                <h6>
                    <strong class="font-semibold text-danger">CAUTION</strong>
                    By choosing to delete, the resources you created all will be removed, your account will be deleted permanently
                    . Therefore, your account will not be an authorized account anymore.
                </h6>

                <div class="form-group mt-4">
                    <label for="password">password</label>
                    <input type="password" class="form-control" name="delete-password" id="password" aria-describedby="title" placeholder="enter password">
                    <small id="title">Provide the password to delete the account</small><br>
                    @error('delete-password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-danger" id="delete-user">Delete</button>
                </div>
            </form>
        </x-slot>
    </x-card>
@endsection

