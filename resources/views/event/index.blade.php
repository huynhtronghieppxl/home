@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" href="css/calendar.css">
    <section>
        <div class="gap gray-bg">
            <div class="container">
                <div class="row" id="page-contents">
                    <div class=" col-lg-12">
                        <div class="central-meta">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script src="js/calendar.js"></script>
@endpush
