@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="info-section">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="stat-box">
                        <i class="fa fa-database text-primary"></i>
                        <div class="anlytc-meta">
                            <h4 id="in-amount">0</h4>
                            <span>Tổng tích luỹ</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="stat-box">
                        <i class="fa fa-sign-in text-danger"></i>
                        <div class="anlytc-meta">
                            <h4 id="out-amount">0</h4>
                            <span>Đã dùng</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="stat-box">
                        <i class="fa fa-archive text-success"></i>
                        <div class="anlytc-meta">
                            <h4 id="current-amount">0</h4>
                            <span>Hiện có</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-block pt-3">
            <div class="table-responsive new-table">
                <table id="table-reserve-fund" class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày</th>
                        <th>Số tiền</th>
                        <th>Ghi chú</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('reserve_fund.create')
    @include('reserve_fund.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\reserve_fund\index.js')}}"></script>
@endpush
