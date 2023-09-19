<div class="popup-wraper3" id="modal-create-reserve-fund">
    <div class="popup">
        <div class="popup-meta">
            <div class="popup-head">
                <h4>Thêm phiếu chi tiêu</h4>
            </div>
            <div class="Rpt-meta">
                <form class="c-form">
                    <div class="p-0 m-0">
                        <div class="form-input-crm">
                            <label>Số tiền</label>
                            <input id="amount-create-reserve-fund" class="format-number-setting"
                                   data-type="currency-edit"
                                   data-max="999999999" value=""/>
                            <p class="error-message-crm"></p>
                        </div>
                        <div class="form-input-crm">
                            <label>Ngày</label>
                            <input type="text" id="time-create-reserve-fund" value="{{date('d/m/Y')}}" data-time="1"/>
                            <p class="error-message-crm"></p>
                        </div>
                        <div class="form-input-crm">
                            <label>Mô tả</label>
                            <textarea class="mb-7" type="text" id="description-create-reserve-fund" cols="4"
                                      data-max-length="255" rows="4"></textarea>
                            <p class="error-message-crm"></p>
                        </div>
                    </div>
                    <div class="pt-4 m-0">
                        <button data-ripple="" type="button" class="main-btn"
                                onclick="saveModalCreate()">Lưu
                            lại
                        </button>
                        <a href="javascript:void(0)" onclick="closeModalCreate()" data-ripple=""
                           class="main-btn3 cancel">Đóng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/reserve_fund/create.js')}}"></script>
@endpush
