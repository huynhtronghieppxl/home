@extends('layouts.layout')
@section('content')
    <section>
        <div class="container-profile">
            <div class="profile-layout">
                <div class="crm-contain-wrapper" id="setting-wrapper">
                    <div class="row" id="modal-create-setting">
                        <div class="col-sm">
                            <div class="central-meta max-height-profile" id="setting-central">
                            <span class="create-post d-flex align-items-center justify-content-between"
                                  style="margin-bottom: 20px !important;">
                                Thông tin thiết lập
                                <div class="crm-edit-tool align-items-center">
                                    <i class="crm-edit-tool-icon fa-solid fa-floppy-disk" id="btn-save-profile"
                                       data-toggle="tooltip" data-placement="top" data-original-title="Lưu"
                                       onclick="updateSetting()"></i>
                                </div>
                            </span>
                                <div class="overflow-y-auto-profile" id="content-setting">
                                    <form class="c-form">
                                        <div class="row">
                                            <div class="setting-left col-6">
                                                <div class="col-12">
                                                    <div class="form-input-crm">
                                                        <label> <i class="fa fa-hourglass-3 text-danger"></i> Tiền chi tiêu hàng tháng</label>
                                                        <input type="text" id="time-late" data-type="currency-edit" data-max="120" value="18,700,000"/>
                                                        <p class="error-message-crm"></p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-input-crm">
                                                        <label><i class="fa fa-money text-danger"> </i> Tiền dự phòng khi kết quỹ</label>
                                                        <input type="text" class="format-number-setting"
                                                               id="amount-late" data-type="currency-edit"
                                                               data-max="999999999" value="2,000,000"/>
                                                        <p class="error-message-crm"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/setting/index.js')}}"></script>
@endpush
