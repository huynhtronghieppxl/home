let checkSaveCreateAsset;
$(function () {
    $(document).on('change', '#thumb-create-asset', async function () {
        let input = document.querySelector("#thumb-create-asset");
        let file = input.files[0];
        let fileURL = URL.createObjectURL(file);
        let data = await uploadMediaTemplate(file);
        $("#image-create-asset").attr("src", fileURL);
        $("#image-create-asset").attr("data-src", data.data[0]);
    });
});

function openModalCreateAsset() {
    $('#modal-create-asset').addClass('active')
}

async function saveModalCreateAsset() {
    if ($('#image-create-asset').attr('data-src') === '') {
        WarningNotify('Vui lòng chọn ảnh !')
        return false;
    }
    if (checkSaveCreateAsset === 1) return false;
    checkSaveCreateAsset = 1;
    let method = 'post',
        url = 'asset.create',
        param = null,
        data = {
            name: $('#name-create-asset').val(),
            description: $('#description-create-asset').val(),
            amount: removeformatNumber($('#amount-create-asset').val()),
            time: moment($('#time-create-asset').val(), 'DD/MM/YYYY').format('MM/DD/YYYY'),
            image: $('#image-create-asset').attr('data-src'),
        };
    let res = await axiosTemplate(method, url, param, data);
    checkSaveCreateAsset = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify()
            closeModalCreate();
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

function closeModalCreateAsset() {
    $('#modal-create-asset').removeClass('active');
    $('#name-create-asset').val('');
    $('#description-create-asset').val('');
    $('#amount-create-asset').val(0);
    $('#time-create-asset').val(moment().format('DD//YYYY')).trigger('dp.change');
    $('#image-create-asset').attr('data-src', '')
}
