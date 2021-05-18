@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('expire'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/caution.svg')}}" alt="good icone">
            <p>{{Session::get('expire')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
@endsection
