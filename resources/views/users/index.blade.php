@extends('layouts.layout-with-sidebar_menu')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset('/css/user-style.css')}}">
@endsection
@section('body')
    @include('layouts.navbar')
    <h3 class="heading mt-4">Users</h3>

    <!--dropdown to filter the role of the users-->
    <div class=" dropdown filter mb-5"  >
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            filter
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($roles as $role)
                <li><a class="dropdown-item" href="{{url('/users/'.$role->name)}}">{{$role->name}}</a></li>
            @endforeach
        </ul>
        <a class="btn btn-primary create" href="{{route('user.create')}}">+ Create user</a>
    </div>

    <h5 class="badge bg-success" style="margin-left: 40vh">{{session()->get('status')}}</h5>
    <!--filtered user (default : all users) paginated 10 users per page-->
    <div class="users">
        @foreach($users as $key=>$user)
            <div class="accordion mb-2 mt-3" id="accordionExample">
                <div class="accordion-item border-dark">
                    <h2 class="accordion-header" id="{{$key}}">
                        <button class="accordion-button bg-white" type="button" data-bs-toggle="collapse" data-bs-target="{{'#collapse'.$key}}" aria-expanded="false" aria-controls="collapseOne">
                            <span class="mx-2 details">{{'#'.$user->id}}</span>
                            <span class="details">{{$user->name}}</span>
                            <i class="clock"> registered on</i>
                            <span class="details time ">{{date(' Y/m/d \a\t h:i:s A', strtotime($user->created_at))}}</span>
                        </button>
                    </h2>
                    <div id="{{'collapse'.$key}}" class="accordion-collapse collapse show" aria-labelledby="{{$key}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>

                                <!--user's email-->
                                email :
                                <span class="mx-2">{{$user->email}}</span><br>

                                <!--role of the registered user-->
                                @foreach($user->roles as $role)
                                    role :
                                    <span class="mx-2 badge bg-warning ">{{$role->name}}</span>
                                @endforeach

                                @if(! $user->hasAnyRole('Admin|Agent'))
                                    role :
                                    <span class="mx-2 badge bg-warning ">User</span><br>

                                    <!--no of tickets raised by users-->
                                    # of tickets raised:
                                    <span class="mx-2">{{$user->tickets->count()}}</span>
                                @endif

                            </strong><br>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary" href="{{route('user.edit',$user->id)}}">Edit</a>
                                <form method="POST" action="{{route('user.destroy', $user->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-2">Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    {{$users->links()}}
@endsection
