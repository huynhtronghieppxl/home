@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <div class="table-responsive new-table">
                <div class="select-filter-dataTable">
                    <select id="select-role-employee-data"></select>
                    <select id="select-position-employee-data">
                        <option value="-1">Chức vụ</option>
                        <option value="1">Giám đốc</option>
                        <option value="2">Quản lý</option>
                        <option value="3">Trưởng nhóm</option>
                        <option value="4">Phó nhóm</option>
                        <option value="5">Nhân viên</option>
                        <option value="6">Thực tập sinh</option>
                    </select>
                    <select id="select-status-employee-data">
                        <option value="-1">Trạng thái</option>
                        <option value="2">Tạm khóa</option>
                        <option value="1">Đang hoạt động</option>
                        <option value="0">Thôi việc</option>
                    </select>
                </div>
                <table id="table-employee-manage" class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Lần đăng nhập cuối</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\user\index.js')}}"></script>
@endpush
