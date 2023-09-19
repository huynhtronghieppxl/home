let checkSaveRemove = 0;

$(function () {
    loadData();
    $('#type-addition-fee-type').on('change', function (){
        loadData();
    })
})

async function loadData() {
    let method = "get",
        url = "addition-fee-type.data",
        params = {type: $('#type-addition-fee-type').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTableUser(res.data[0].original.data);
}

async function dataTableUser(data) {
    let id = $("#table-addition-fee-type"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "name", name: "name", className: "text-center"},
            {data: "type", name: "type", className: "text-center"},
            {data: "action", name: "action", className: "text-center", width: "10%"},
        ],
        option = [
            {
                title: "Thêm mới",
                icon: "fa fa-plus text-primary",
                class: "",
                function: "openModalCreateAdditionFeeType",
            },
        ];
    DatatableTemplate(id, data, columns, heightScrollDatatable, fixed_left, fixed_right, option);
}

async function remove(id) {
    if (checkSaveRemove === 1) return false;
    checkSaveRemove = 1;
    let method = "post",
        url = "addition-fee-type.remove",
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
