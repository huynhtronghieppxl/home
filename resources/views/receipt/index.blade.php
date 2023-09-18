@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <div class="table-responsive new-table">
                <div class="select-filter-dataTable">
                    <div class="select-by-month">
                        <div class="time-filer-dataTale">
                            <input class="by-month pb-1" type="text"
                                   value="{{date('m/Y')}}" autocomplete="off" id="time-receipt"/>
                        </div>
                    </div>
                    <select id="select-type-receipt">
                        <option value="0">Tất cả</option>
                    </select>
                </div>
                <table id="table-receipt" class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày</th>
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
    @include('receipt.create')
    @include('receipt.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\receipt\index.js')}}"></script>
@endpush
