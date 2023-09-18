<div class="popup-wraper3" id="modal-create-asset">
    <div class="popup">
        <div class="popup-meta">
            <div class="popup-head">
                <h4>Thêm tài sản</h4>
            </div>
            <div class="Rpt-meta">
                <form class="c-form">
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center pt-5">
                            <div class="change-photo-event text-center">
                                <div
                                    class="profile-author-thumb  d-flex align-items-center justify-content-center position-relative pt-2">
                                    <img class="image-book-crm" alt="author" id="image-create-asset"
                                         src="images/default.gif" data-src=""
                                         onerror="imageDefaultOnLoadError($(this))">
                                    <div class="edit-dp label-book-crm" style="right: 39px">
                                        <label class="fileContainer">
                                            <i class="fa fa-camera"></i>
                                            <input id="thumb-create-asset" type="file" accept=".png, .jpg, .jpeg">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center row">
                            <div class="col-lg-12">
                                <div class="form-input-crm">
                                    <label>Tên</label>
                                    <input type="text" id="name-create-asset" data-empty="1" data-min-length="2"
                                           data-max-length="100" data-emoji="1" data-spec="1">
                                    <p class="error-message-crm"></p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-input-crm">
                                    <label>Giá tiền</label>
                                    <input id="amount-create-asset" class="format-number-setting"
                                           data-type="currency-edit"
                                           data-max="999999999" value=""/>
                                    <p class="error-message-crm"></p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-input-crm">
                                    <label>Ngày mua</label>
                                    <input type="text" id="time-create-asset" value="{{date('d/m/Y')}}" data-time="1"/>
                                    <p class="error-message-crm"></p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-input-crm">
                                    <label>Mô tả</label>
                                    <textarea class="mb-7" type="text" id="description-create-asset" cols="4"
                                              data-max-length="255" rows="4"></textarea>
                                    <p class="error-message-crm"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 m-0">
                        <button data-ripple="" type="button" class="main-btn" onclick="saveModalCreateAsset()">Lưu
                            lại
                        </button>
                        <a href="javascript:void(0)" onclick="closeModalCreateAsset()" data-ripple=""
                           class="main-btn3 cancel">Đóng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/asset/create.js')}}"></script>
@endpush
