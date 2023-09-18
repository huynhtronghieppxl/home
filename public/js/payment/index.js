let checkSaveRemove = 0;

$(function () {
    dateTimePickerMonthYear($("#time-payment"));
    loadDataType();
    loadData();
    $('#select-type-payment').on('change', function () {
        loadData();
    })
})

async function loadData() {
    let method = "get",
        url = "payment.data",
        params = {
            from: moment($('#time-payment').val(), 'MM/YYYY').format('MM/01/YYYY'),
            to: moment($('#time-payment').val(), 'MM/YYYY').endOf('month').format('MM/DD/YYYY'),
            type: $('#select-type-payment').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTable(res.data[0].original.data);
}

async function loadDataType() {
    let method = "get",
        url = "payment.data-type",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    $('#select-type-payment').append(res.data[0]).trigger("chosen:updated");
    $('#type-create-payment').html(res.data[0]).trigger("chosen:updated");
    $('#type-update-payment').html(res.data[0]).trigger("chosen:updated");
}

async function dataTable(data) {
    let id = $("#table-payment"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "time", name: "time", className: "text-center"},
            {data: "type", name: "type", className: "text-center"},
            {data: "amount", name: "amount", className: "text-center"},
            {data: "description", name: "description", className: "text-left"},
            {data: "action", name: "action", className: "text-center", width: "10%"},
        ],
        option = [
            {
                title: "Thêm mới",
                icon: "fa fa-plus text-primary",
                class: "",
                function: "openModalCreate",
            },
        ];
    DatatableTemplate(id, data, columns, heightScrollDatatable, fixed_left, fixed_right, option);
}

async function remove(id) {
    if (checkSaveRemove === 1) return false;
    checkSaveRemove = 1;
    let method = "post",
        url = "payment.remove",
        params = null,
        data = {id: id};
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    checkSaveRemove = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify()
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
