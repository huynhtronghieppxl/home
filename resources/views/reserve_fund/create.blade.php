<div class="popup-wraper3" id="modal-create-addition-fee-type">
    <div class="popup">
        <div class="popup-meta">
            <div class="popup-head">
                <h4>Thêm phiếu thu/chi</h4>
            </div>
            <div class="Rpt-meta">
                <form class="c-form">
                    <div class="p-0 m-0">
                        <label>Hạng mục thu/chi</label>
                        <div class="form-input-crm">
                            <select id="type-create-addition-fee-type" data-select="1">
                                <option value="0" selected>Phiếu thu</option>
                                <option value="1">Phiếu chi</option>
                            </select>
                        </div>
                        <div class="form-input-crm">
                            <label>Tên</label>
                            <input id="name-create-addition-fee-type" class="text-left" value="" type="text"/>
                            <p class="error-message-crm"></p>
                        </div>
                    </div>
                    <div class="pt-4 m-0">
                        <button data-ripple="" type="button" class="main-btn"
                                onclick="saveModalCreateAdditionFeeType()">Lưu
                            lại
                        </button>
                        <a href="javascript:void(0)" onclick="closeModalCreateAdditionFeeType()" data-ripple=""
                           class="main-btn3 cancel">Đóng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/addition_fee_type/create.js?version=1')}}"></script>
@endpush
