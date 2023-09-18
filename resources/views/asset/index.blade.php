@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <div class="table-responsive new-table">
                <table id="table-asset" class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Ngày mua</th>
                        <th>Số tiền</th>
                        <th>Mô tả</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('asset.create')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\asset\index.js')}}"></script>
@endpush
