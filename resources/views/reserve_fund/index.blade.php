@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <div class="table-responsive new-table">
                <div class="select-filter-dataTable">
                    <div class="select-by-month">
                        <div class="time-filer-dataTale">
                            <input class="by-month pb-1" type="text"
                                   value="{{date('m/Y')}}" autocomplete="off" id="time-addition-fee"/>
                        </div>
                    </div>
                    <select id="select-type-addition-fee">
                        <option value="-1">Tất cả</option>
                        <option value="0">Phiếu thu</option>
                        <option value="1">Phiếu chi</option>
                    </select>
                    <select id="select-addition-fee-type-addition-fee">
                        <option value="-1">Tất cả</option>
                    </select>
                </div>
                <table id="table-addition-fee" class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày</th>
                        <th>Loại</th>
                        <th>Hạng mục</th>
                        <th>Số tiền</th>
                        <th>Ghi chú</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('addition_fee.create')
    @include('addition_fee.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\addition_fee\index.js')}}"></script>
@endpush
