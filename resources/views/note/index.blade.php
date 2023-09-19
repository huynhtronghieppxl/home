@extends('layouts.layout')
@section('content')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <div class="crm-contain-wrapper" id="layout-note-crm">
        <div class="row note-container">
            <div class="note-list card ml-3  ">
                <div class="d-flex position-relative align-items-baseline content-title-note">
                    <span class="create-post mb-0">Ghi chú của bạn</span>
                    <div class="icon-create-message" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="Tạo ghi chú">
                        <i class="fa-solid fa-pencil-square-o cursor-pointer icon-create-note"></i>
                    </div>
                </div>

                <div class="note-list-today option-border">
                    <span class="time-title-note"> Hôm nay</span>
                    <div id="list-all-note-today"></div>
                </div>
                <div class="note-list-month option-border">
                    <span class="time-title-note"> 30 ngày trước</span>
                    <div id="list-all-note-month"></div>

                </div>
            </div>
            <div class="note-content-right card ml-3 pt-4">
                <div class="container">

                </div>
            </div>

        </div>


    </div>

@endsection
@push('scripts')
    <script src="{{asset('js/note/index.js')}}"></script>
    <script src="{{asset('js/template_custom/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template_custom/ckeditor.js')}}"></script>
@endpush
