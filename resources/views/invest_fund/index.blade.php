@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <ul class="nav nav-tabs md-tabs" role="tablist">
                <li class="nav-item crm-nav-item" aria-expanded="false">
                    <a class="nav-link crm-nav-link active" data-toggle="tab" href="#tab-1" role="tab"
                       aria-expanded="false">
                        Kỳ đầu tư
                    </a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item crm-nav-item">
                    <a class="nav-link crm-nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-expanded="true">
                        Lịch sử nạp
                    </a>
                    <div class="slide"></div>
                </li>
            </ul>
            <div class="tab-content mt-2">
                <div class="tab-pane active" id="tab-1" role="tabpanel" aria-expanded="true">
                    <div class="table-responsive new-table">
                        <table id="table-period" class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tháng</th>
                                <th>Tiền đầu kỳ</th>
                                <th>Tiền trong kỳ</th>
                                <th>Tổng nạp</th>
                                <th>Số dư hiện tại</th>
                                <th>Lợi nhuận</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab-2" role="tabpanel" aria-expanded="true">
                    <div class="table-responsive new-table">
                        <table id="table-data" class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ngày</th>
                                <th>Số tiền</th>
                                <th>Mô tả</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\invest_fund\index.js')}}"></script>
@endpush
