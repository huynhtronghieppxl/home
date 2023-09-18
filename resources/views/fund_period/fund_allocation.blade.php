<div class="popup-wraper3" id="modal-fund-allocation">
    <div class="popup">
        <div class="popup-meta">
            <div class="popup-head">
                <h4>Phân bổ số dư</h4>
            </div>
            <div class="Rpt-meta">
                <form class="c-form">
                    <div class="p-0 m-0">
                        <div class="form-input-crm">
                            <label>Số dư khả dụng</label>
                            <h5 id="amount-fund-allocation"></h5>
                            <p class="error-message-crm"></p>
                        </div>
                        <div class="form-input-crm">
                            <label>Dự phòng</label>
                            <input id="reserve-fund-allocation" class="format-number-setting"
                                   data-type="currency-edit"
                                   data-max="999999999" value=""/>
                            <p class="error-message-crm"></p>
                        </div>
                        <div class="form-input-crm">
                            <label>Đầu tư</label>
                            <input id="invest-fund-allocation" class="format-number-setting"
                                   data-type="currency-edit"
                                   data-max="999999999" value=""/>
                            <p class="error-message-crm"></p>
                        </div>
                    </div>
                    <div class="pt-4 m-0">
                        <button data-ripple="" type="button" class="main-btn"
                                onclick="saveModalFundAllocation()">Lưu
                            lại
                        </button>
                        <a href="javascript:void(0)" onclick="closeModalFundAllocation()" data-ripple=""
                           class="main-btn3 cancel">Đóng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/fund_period/fund_allocation.js?version=1')}}"></script>
@endpush
