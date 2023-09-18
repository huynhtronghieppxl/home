let checkSaveUpdateAdditionFeeType = 0, idUpdateAdditionFeeType;

function openModalUpdateAdditionFeeType(id) {
    idUpdateAdditionFeeType = id;
    $('#modal-update-addition-fee-type').addClass('active');
}

async function saveModalUpdateAdditionFeeType() {
    if (checkSaveUpdateAdditionFeeType === 1) return false;
    checkSaveUpdateAdditionFeeType = 1;
    let method = 'post',
        url = 'addition-fee-type.update',
        params = {},
        data = {
            id: idUpdateAdditionFeeType,
            name: $('#name-update-addition-fee-type').val(),
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveUpdateAdditionFeeType = 0
    switch (res.data.status) {
        case 200:
            SuccessNotify()
            closeModalUpdateAdditionFeeType();
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

function closeModalUpdateAdditionFeeType() {
    $('#modal-update-addition-fee-type').removeClass('active');
    $('#name-update-addition-fee-type').val('');
    $('#type-update-addition-fee-type').val('0').trigger('change');
}
