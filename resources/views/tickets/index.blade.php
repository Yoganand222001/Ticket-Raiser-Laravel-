@extends('layouts.layout-with-sidebar_menu')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset('/css/ticket-style.css')}}">
@endsection
@section('body')
    @include('layouts.navbar')
    <h3 class="heading mt-4">Tickets</h3>

    <!--filters for the tickets-->
    <div class="filter d-inline-flex">

        <!--dropdown to filter open and closed tickets-->
        <span class="mx-2">
        <x-dropdown>
            <x-slot name="dropdown_heading">
                status
            </x-slot>
            <x-slot name="dropdown_contents">
                <form method="get" class="status_filter">
                    <label class="checkbox mt-2 mx-2" for="open">
                            <input type="checkbox" name="status" id="open" value="open" checked>
                            Open
                    </label><br>
                    <label class="checkbox mt-2 mx-2" for="closed">
                            <input type="checkbox" name="status" id="closed" value="closed">
                            Closed
                    </label>
                </form>
            </x-slot>
        </x-dropdown>
        </span>

        <!--dropdown to filter priority-->
        <span class="mx-2">
        <x-dropdown>
            <x-slot name="dropdown_heading">
                priority
            </x-slot>
            <x-slot name="dropdown_contents">
                <form method="get" class="priority_filter">
                    <label class="checkbox mt-2 mx-2" for="high">
                            <input type="checkbox" name="priority" id="high" value="high" checked>
                            high
                    </label><br>
                    <label class="checkbox mt-2 mx-2" for="low">
                            <input type="checkbox" name="priority" id="low" value="low" checked>
                            low
                    </label>
                </form>
            </x-slot>
        </x-dropdown>
        </span>

        <!--dropdown to filter categories-->
        <span class="mx-2">
        <x-dropdown>
            <x-slot name="dropdown_heading">
                categories
            </x-slot>
            <x-slot name="dropdown_contents">
                <form method="get" class="categories_filter">
                    @foreach($categories as $key=>$category)
                        <label class="checkbox mt-2 mx-2" for="{{'_'.$key}}">
                            <input type="checkbox" name="categories" id="{{'_'.$key}}" value={{$category->id}}>
                            {{$category->category}}
                        </label>
                    @endforeach
                </form>
            </x-slot>
        </x-dropdown>
        </span>

        <span class="mx-2">
            <button class="btn btn-primary" id="filters">filter</button>
        </span>

        <p class="text-danger dropdown-empty-error"></p>

        <!--raise new ticket-->
        @if(! auth()->user()->hasAnyRole('Admin','Agent'))
            <a class="btn btn-primary create d-block" href="{{route('ticket.create')}}">+ Raise ticket</a>
        @endif

    </div>

    <!--filtered tickets (default : open) paginated 10 tickets per page-->
    <div class="tickets"></div>
@endsection

@section('scripts-link')
                <script src="{{asset('Js/jquery-3.6.3.min.js')}}"></script>
                <script src="{{asset('Js/async_filter_requests.js')}}"></script>
@endsection
