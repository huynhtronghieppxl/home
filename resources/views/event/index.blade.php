@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" href="css/calendar.css">
{{--    <style>--}}
{{--        .fc-content {--}}
{{--            overflow-y: auto;--}}
{{--            max-height: 500px;--}}
{{--        }--}}
{{--    </style>--}}
    <div class="crm-contain-wrapper">
        <div class="container">
            <div class="card card-block pt-3">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="js/calendar.js"></script>
    <script src="js/event/index.js"></script>
@endpush
