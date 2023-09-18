@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <div class="table-responsive new-table">
                <table id="table-fund-period" class="table">
                    <thead>
                    <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Tháng</th>
                        <th rowspan="2">Quỹ đầu kỳ</th>
                        <th rowspan="2">Thu</th>
                        <th rowspan="2">Chi</th>
                        <th rowspan="2">Dư cuối kỳ</th>
                        <th colspan="4">Phân bổ quỹ</th>
                        <th rowspan="2">Trạng thái</th>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>Quỹ kỳ sau</th>
                        <th>Dự phòng</th>
                        <th>Đầu tư</th>
                        <th>Còn lại</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('fund_period.fund_allocation')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\fund_period\index.js')}}"></script>
@endpush
