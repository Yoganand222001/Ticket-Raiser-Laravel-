@extends('layouts.layout')
@section('css-link')
    <link rel="stylesheet" href="{{asset('/css/nav-style.css')}}">
    @yield('stylesheets')
@endsection
@section('content')

    <!--sidebar Menu -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky mt-6">
            <h5>
                <div class="list-group list-group-flush mx-3 mt-4">

                    <!-- dashboard -->
                    <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="bi bi-speedometer"></i><span class="mx-4">Dashboard</span>
                    </a>

                    <!-- tickets -->
                    <a href="{{route('tickets.index')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-ticket-detailed-fill"></i><span class="mx-4">Tickets</span>
                    </a>


                    <!-- menus only for Admins -->
                    @hasrole('Admin')

                        <!-- users -->
                        <a href="{{route('users.index')}}" class="list-group-item list-group-item-action py-2 ripple ">
                            <i class="bi bi-people-fill"></i><span class="mx-4">Users</span></a>

                        <!-- categories -->
                        <a href="{{route('categories')}}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="bi bi-bookmark-check-fill"></i><span class="mx-4">Categories</span>
                        </a>

                        <!-- labels -->
                        <a href="{{route('labels')}}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="bi bi-tags-fill "></i><span class="mx-4">Labels</span>
                        </a>

                        <!-- ticket logs -->
                        <a href="{{route('logs')}}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="bi bi-archive"></i><span class="mx-4">Ticket logs</span>
                        </a>
                    @endhasrole
                </div>
            </h5>
        </div>
    </nav>

    @yield('body')
@endsection
