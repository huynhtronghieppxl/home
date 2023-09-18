<div class="popup-wraper3" id="modal-update-payment">
    <div class="popup">
        <div class="popup-meta">
            <div class="popup-head">
                <h4>Sửa phiếu chi</h4>
            </div>
            <div class="Rpt-meta">
                <form class="c-form">
                    <div class="p-0 m-0">
                        <label>Hạng mục</label>
                        <div class="form-input-crm">
                            <select id="type-update-payment" data-select="1"></select>
                        </div>
                        <div class="form-input-crm">
                            <label>Giá tiền</label>
                            <input id="amount-update-payment" class="format-number-setting"
                                   data-type="currency-edit"
                                   data-max="999999999" value=""/>
                            <p class="error-message-crm"></p>
                        </div>
                        <div class="form-input-crm">
                            <label>Ngày</label>
                            <input type="text" id="time-update-payment" value="{{date('d/m/Y')}}" data-time="1"/>
                            <p class="error-message-crm"></p>
                        </div>
                        <div class="form-input-crm">
                            <label>Mô tả</label>
                            <textarea class="mb-7" type="text" id="description-update-payment" cols="4"
                                      data-max-length="255" rows="4"></textarea>
                            <p class="error-message-crm"></p>
                        </div>
                    </div>
                    <div class="pt-4 m-0">
                        <button data-ripple="" type="button" class="main-btn"
                                onclick="saveModalUpdate()">Lưu
                            lại
                        </button>
                        <a href="javascript:void(0)" onclick="closeModalUpdate()" data-ripple=""
                           class="main-btn3 cancel">Đóng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/payment/update.js?version=1')}}"></script>
@endpush
