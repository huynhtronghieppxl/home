let checkSaveRemove = 0;

$(function () {
    loadData();
})

async function loadData() {
    let method = "get",
        url = "reserve-fund.data",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTable(res.data[0].original.data);
    $('#in-amount').text(res.data[1].in);
    $('#out-amount').text(res.data[1].out);
    $('#current-amount').text(res.data[1].current);
}

async function dataTable(data) {
    let id = $("#table-reserve-fund"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "time", name: "time", className: "text-center"},
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
        url = "reserve-fund.remove",
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
