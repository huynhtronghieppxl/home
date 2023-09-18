let checkSaveCreateAdditionFeeType = 0;

function openModalCreateAdditionFeeType() {
    $('#modal-create-addition-fee-type').addClass('active');
}

async function saveModalCreateAdditionFeeType() {
    if (checkSaveCreateAdditionFeeType === 1) return false;
    checkSaveCreateAdditionFeeType = 1;
    let method = 'post',
        url = 'addition-fee-type.create',
        params = {},
        data = {
            name: $('#name-create-addition-fee-type').val(),
            type: $('#type-create-addition-fee-type').val()
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveCreateAdditionFeeType = 0
    switch (res.data.status) {
        case 200:
            SuccessNotify()
            closeModalCreateAdditionFeeType();
            loadData();
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
            break;
    }
}

function closeModalCreateAdditionFeeType() {
    $('#modal-create-addition-fee-type').removeClass('active');
    $('#name-create-addition-fee-type').val('');
    $('#type-create-addition-fee-type').val('0').trigger('change');
}
