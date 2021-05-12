@extends('layouts.app')
@section('content')
    @if (Session::has('success-inscription'))
        <div id="successMsg" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="cross icone">
            <p>{{Session::get('success-inscription')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
@endsection
@section('scripts')
    <script src="{{asset('js/successMsg.js')}}"></script>
@endsection
