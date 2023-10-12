@extends('layouts.layout-with-sidebar_menu')
@section('body')
    @include('layouts.navbar')
    <div style="margin-left: 40vh" class="logs"></div>
    <button style="margin-left: 40vh" class="mt-3 mb-2 btn btn-primary load_data">Load past activities</button>
    <script src="{{asset('Js/jquery-3.6.3.min.js')}}"></script>
    <script src="{{asset('Js/logs_request.js')}}"></script>
@endsection
