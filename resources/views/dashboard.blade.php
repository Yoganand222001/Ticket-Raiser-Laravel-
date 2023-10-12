@extends('layouts.layout-with-sidebar_menu')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset('/css/dashboard-style.css')}}">
@endsection
@section('body')
    @include('layouts.navbar')
    <div style="margin-left: 40vh">
        <h1 class="font-bold mt-4" >Dashboard</h1>
        <div class="mt-4 ticket">
            <h4 class="#-of-tickets">
                @if($count)
                    <i class="fa-solid fa-ticket ticket-logo"></i>
                    <span class="description">{{$count}} of the tickets are open</span>
                @else
                    <i class="fa fa-thumbs-up"></i>
                    <span class="description">No Tickets are open</span>
                @endif

            </h4>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/0053c862e9.js" crossorigin="anonymous"></script>
@endsection

