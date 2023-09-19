@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <div class="table-responsive new-table">
                <div class="select-filter-dataTable">
                    <select id="type-addition-fee-type">
                        <option value="-1">Tất cả</option>
                        <option value="0">Khoản thu</option>
                        <option value="1">Khoản chi</option>
                    </select>
                </div>
                <table id="table-addition-fee-type" class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @include('addition_fee_type.create')
    @include('addition_fee_type.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\addition_fee_type\index.js')}}"></script>
@endpush
