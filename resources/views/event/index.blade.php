@extends('layouts.layout')
@section('content')
    {{--    <link rel="stylesheet" href="css/calendar.css">--}}
    <!-- Add the evo-calendar.css for styling -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/css/evo-calendar.min.css"/>
    {{--    <style>--}}
    {{--        .fc-content {--}}
    {{--            overflow-y: auto;--}}
    {{--            max-height: 500px;--}}
    {{--        }--}}
    {{--    </style>--}}
    <div class="crm-contain-wrapper">
        <div class="container">
            <div class="card card-block pt-3">
                <div id="evoCalendar"></div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <!-- Add the evo-calendar.js for.. obviously, functionality! -->
    <script src="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/js/evo-calendar.min.js"></script>
    <script>
        $("#evoCalendar").evoCalendar({
            calendarEvents: [
                {
                    id: 'bHay68s', // Event's ID (required)
                    name: "New Year", // Event name (required)
                    description: 'Là sao',
                    date: new Date(), // Event date (required)
                    type: "holiday", // Event type (required)
                    everyYear: true // Same event every year (optional)
                },
                {
                    name: "Vacation Leave",
                    badge: "02/13 - 02/15", // Event badge (optional)
                    date: new Date(), // Date range
                    description: "Vacation leave for 3 days.", // Event description (optional)
                    type: "event",
                    color: "#63d867" // Event custom color (optional)
                }
            ]
        });
    </script>
@endpush
