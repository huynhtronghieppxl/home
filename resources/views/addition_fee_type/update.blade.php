<div class="popup-wraper3" id="modal-update-addition-fee-type">
    <div class="popup">
        <div class="popup-meta">
            <div class="popup-head">
                <h4>Sửa hạng mục thu/chi</h4>
            </div>
            <div class="Rpt-meta">
                <form class="c-form">
                    <div class="p-0 m-0">
                        <label>Loại</label>
                        <div class="form-input-crm" id="type-update-addition-fee-type"></div>
                        <div class="form-input-crm">
                            <label>Tên</label>
                            <input id="name-update-addition-fee-type" class="text-left" value="" type="text"/>
                            <p class="error-message-crm"></p>
                        </div>
                    </div>
                    <div class="pt-4 m-0">
                        <button data-ripple="" type="button" class="main-btn"
                                onclick="saveModalUpdateAdditionFeeType()">Lưu
                            lại
                        </button>
                        <a href="javascript:void(0)" onclick="closeModalUpdateAdditionFeeType()" data-ripple=""
                           class="main-btn3 cancel">Đóng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/addition_fee_type/update.js?version=1')}}"></script>
@endpush
